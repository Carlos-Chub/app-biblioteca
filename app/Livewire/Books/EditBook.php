<?php

namespace App\Livewire\Books;

use App\Models\Author;
use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Editbook extends Component
{
    use LivewireAlert;
    public $open = false;
    public $book;

    public $book_id;
    public $title;
    public $author_id;
    public $pages;
    public $book_case;
    public $row;
    public $authors;

    protected $listeners = ['editbook' => 'editbook'];

    public function mount()
    {
        $this->authors = Author::all(); // Cargar todos los autores
    }
    public function render()
    {
        return view('livewire.books.edit-book');
    }
    public function editbook($id)
    {
        $this->book = Book::findOrFail($id);

        $this->book_id = $this->book->id;
        $this->title = $this->book->title;
        $this->author_id = $this->book->author_id;
        $this->pages = $this->book->pages;
        $this->book_case = $this->book->book_case;
        $this->row = $this->book->row;

        $this->open = true;
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

        $book = Book::findOrFail($this->book_id);
        $book->title = $this->title;
        $book->author_id = $this->author_id;
        $book->pages = $this->pages;
        $book->book_case = $this->book_case;
        $book->row = $this->row;
        
        $book->save();
    
        $this->alert('success', 'Libro actualizado con éxito');

        $this->dispatch('refreshBooks');
        $this->reset(['title', 'author_id', 'pages', 'book_case', 'row', 'open']);
    }
}
