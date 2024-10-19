<?php

namespace App\Livewire\Books;

use App\Models\Author;
use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateBook extends Component
{
    use LivewireAlert;
    public $open = false;
    public $title;
    public $author_id;
    public $pages;
    public $book_case;
    public $row;
    public $authors;

    public function mount()
    {
        $this->authors = Author::all();
    }
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'pages' => 'required|integer|min:1',
            'book_case' => 'required|string|max:255',
            'row' => 'required|string|max:255',
        ]);

        Book::create([
            'uuid' => hexdec(uniqid()),
            'title' => $this->title,
            'author_id' => $this->author_id,
            'pages' => $this->pages,
            'book_case' => $this->book_case,
            'row' => $this->row,
        ]);
        $this->alert('success', '¡El Libro ha sido creado exitosamente!');

        $this->dispatch('refreshBooks');
        $this->reset(['title', 'author_id', 'pages', 'book_case', 'row', 'open']);
    }
    public function render()
    {
        return view('livewire.books.create-book');
    }
}
