<?php

namespace App\Console\Commands;

use App\Models\BookReader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendWhatsAppMessage extends Command
{
    protected $signature = 'app:send-whatsapp-message';
    protected $description = 'Send WhatsApp messages for upcoming book returns using the Gupshup API';

    public function handle(): void
    {
        $upcomingReturns = BookReader::getUpcomingReturnsWhatsapp(1, 2);

        Log::info('Processing upcoming returns', ['count' => $upcomingReturns->count()]);

        foreach ($upcomingReturns as $bookReader) {
            $this->sendReminderMessage($bookReader);
        }

        Log::info('Finished WhatsApp message send task');
    }

    private function sendReminderMessage(BookReader $bookReader): void
    {
        $daysUntilReturn = Carbon::now()->diffInDays($bookReader->return_date);
        $message = $this->composeMessage($bookReader, $daysUntilReturn);

        try {
            if (config('services.gupshup.mode') == 2) {
                //ENVIO DE MENSAJE DE PLANTILLA
                $response = $this->sendTemplateMessage($bookReader->reader->phone, config('services.gupshup.template_id'), [
                    $bookReader->reader->names,
                    $bookReader->book->title,
                    $bookReader->return_date->format('d-m-Y')
                ]);
            } else {
                //ENVIO DE MENSAJE SIMPLE, SIN PLANTILLA
                $response = $this->sendWhatsAppMessage($bookReader->reader->phone, $message);
            }

            $this->logResponse($bookReader, $response);
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp message', [
                'reader' => $bookReader->reader->names,
                'book' => $bookReader->book->title,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function composeMessage(BookReader $bookReader, int $daysUntilReturn): string
    {
        return "Estimado: {$bookReader->reader->names}, Le recordamos que el libro '{$bookReader->book->title}' debe ser devuelto en {$daysUntilReturn} día(s).";
    }

    private function sendWhatsAppMessage(string $phoneNumber, string $message): \Illuminate\Http\Client\Response
    {
        return Http::asForm()
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'apikey' => config('services.gupshup.api_key'),
            ])
            ->post('https://api.gupshup.io/wa/api/v1/msg', [
                'channel' => 'whatsapp',
                'source' => config('services.gupshup.source_number'),
                'destination' => $phoneNumber,
                'message' => json_encode([
                    'type' => 'text',
                    'text' => $message
                ]),
                'src.name' => config('services.gupshup.source_name')
            ]);
    }
    public function sendTemplateMessage($phoneNumber, $templateId, $params)
    {
        return Http::asForm()
            ->withHeaders([
                'Cache-Control' => 'no-cache',
                'apikey' => config('services.gupshup.api_key'),
            ])
            ->post('https://api.gupshup.io/wa/api/v1/template/msg', [
                'channel' => 'whatsapp',
                'source' => config('services.gupshup.source_number'),
                'destination' => $phoneNumber,
                'src.name' => config('services.gupshup.source_name'),
                'template' => json_encode([
                    'id' => $templateId,
                    'params' => $params
                ])
            ]);
    }

    private function logResponse(BookReader $bookReader, \Illuminate\Http\Client\Response $response): void
    {
        $this->info("Reminder sent to {$bookReader->reader->names} for book {$bookReader->book->title}");
        $this->info($response->body());

        Log::info('WhatsApp API Response', [
            'remitente' => config('services.gupshup.source_number'),
            'reader' => $bookReader->reader->names,
            'book' => $bookReader->book->title,
            'phone' => $bookReader->reader->phone,
            'response' => $response->body(),
        ]);
    }
}
