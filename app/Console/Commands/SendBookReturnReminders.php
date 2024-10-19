<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookReader;
use App\Notifications\BookReturnReminderNotification;

class SendBookReturnReminders extends Command
{
    protected $signature = 'app:send-book-return-reminders';
    protected $description = 'Send email reminders for book returns';

    public function handle()
    {
        $upcomingReturns = BookReader::getUpcomingReturnsEmail(1, 2);

        foreach ($upcomingReturns as $bookReader) {
            $reader = $bookReader->reader;
            $reader->notify(new BookReturnReminderNotification($bookReader));
            $this->info("Reminder sent to {$reader->email} for book {$bookReader->book->title}");
        }

        $this->info('All reminders sent successfully.');
    }
}