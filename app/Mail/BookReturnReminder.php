<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BookReader;

class BookReturnReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $bookReader;

    public function __construct(BookReader $bookReader)
    {
        $this->bookReader = $bookReader;
    }

    public function build()
    {
        return $this->view('emails.book-return-reminder')
                    ->subject('Recordatorio de devolución de libro');
    }
}