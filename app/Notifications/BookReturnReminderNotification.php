<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\BookReturnReminder;
use App\Models\BookReader;

class BookReturnReminderNotification extends Notification
{
    use Queueable;

    protected $bookReader;

    public function __construct(BookReader $bookReader)
    {
        $this->bookReader = $bookReader;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new BookReturnReminder($this->bookReader))
                    ->to($notifiable->email);
    }
}