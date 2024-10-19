<?php
 
namespace App\Exports;

use App\Models\BookReader;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookReadersExport implements FromCollection, WithHeadings
{
    public $book_readers_export;
 
    public function __construct($book_readers_export) {
        $this->book_readers_export = $book_readers_export;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombres lector',
            'Apellidos lector',
            'Libro',
            'Estado prestamo libro',
            'Fecha de devolución',
            'SMS',
            'WhatsApp',
            'Email',
        ];
    }
 
    public function collection()
    {
        return BookReader::with(['book:id,title', 'reader:id,names,surnames'])
        ->select('id', 'status', 'book_id', 'reader_id','return_date','sms','whatsapp','email')
        ->whereIn('id', $this->book_readers_export)
        ->get()
        ->map(function ($bookReader) {
            return [
                'id' => $bookReader->id,
                'names' => $bookReader->reader->names ?? null,
                'surnames' => $bookReader->reader->surnames ?? null,
                'book_title' => $bookReader->book->title ?? null,
                'status' => $bookReader->status,
                'return_date' => $bookReader->return_date,
                'sms' => $bookReader->sms ? 'Aplica':'No Aplica',
                'whatsapp' => $bookReader->whatsapp? 'Aplica':'No Aplica',
                'email' => $bookReader->email? 'Aplica':'No Aplica',
            ];
        });
    }
}