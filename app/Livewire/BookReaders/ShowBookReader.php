<?php

namespace App\Livewire\BookReaders;

use App\Models\BookReader;
use Livewire\Component;

class ShowBookReader extends Component
{
    public BookReader $book_reader;

    public function render()
    {
        return view('livewire.book-readers.show-book-reader');
    }
}
