<?php

namespace App\Livewire\BookReaders;

use App\Models\Book;
use App\Models\BookReader;
use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditBookReader extends Component
{
    use LivewireAlert;

    public BookReader $book_reader;
    public $reader;
    public $book;
    public $status;
    public $notifications = [];
    public $return_date;

    public function mount(BookReader $book_reader)
    {
        if ($book_reader->id) {
            $this->book_reader = $book_reader;
            $this->reader = $this->book_reader->reader->id;
            $this->book = $this->book_reader->book->id;
            $this->status = $this->book_reader->status;
            $aux_notifications = [];
            if ($this->book_reader->sms) {
                array_push($this->notifications, 'sms');
            }
            if ($this->book_reader->whatsapp) {
                array_push($this->notifications, 'whatsapp');
            }
            if ($this->book_reader->email) {
                array_push($this->notifications, 'email');
            }
            $this->return_date = $this->book_reader->return_date;
        }
    }

    public function rules()
    {
        return [
            'reader' => ['required', Rule::exists('readers', 'id')],
            'book' => ['required', Rule::exists('books', 'id')],
            'status' => ['required', Rule::in(['pending_assignment', 'assigned_book', 'returned_book'])],
            'notifications' => ['required', 'array', 'min:1', 'max:3'],
            'notifications.*' => [Rule::in(['sms', 'whatsapp', 'email'])],
        ];
    }
    public function save()
    {
        $data_update = [
            'reader_id' => $this->reader,
            'book_id' => $this->book,
            'status' => $this->status,
            'sms' => false,
            'whatsapp' => false,
            'email' => false,
        ];
        foreach ($this->notifications as $notification) {
            if ($notification === 'sms') {
                $data_update['sms'] = true;
            }
            if ($notification === 'whatsapp') {
                $data_update['whatsapp'] = true;
            }
            if ($notification === 'email') {
                $data_update['email'] = true;
            }
        }
        $bookReader = $this->book_reader->update($data_update);
        if (!$bookReader) {
            $this->alert('error', __('Book reader not updated successfully'));
        }
        $this->flash('success', __('Book reader updated successfully'), [], route('book-reader.index'));
    }

    public function render()
    {
        return view('livewire.book-readers.edit-book-reader', [
            'readers_all' => Reader::all(),
            'books_all' => Book::all()
        ]);
    }
}
