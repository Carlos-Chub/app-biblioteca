<?php

namespace App\Livewire\Authors;

use App\Models\Author;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAuthor extends Component
{
    use LivewireAlert;

    public $open = false;
    public $authorId;
    public $author;
    public $names, $surnames;

    protected $rules = [
        'names' => 'required|string|min:3', // 'names' es obligatorio y debe tener al menos 3 caracteres
        'surnames' => 'nullable|string',
    ];

    protected $listeners = ['editauthor' => 'editauthor'];

    public function render()
    {
        return view('livewire.authors.edit-author', [
            'author' => $this->author
        ]);
    }
    public function editauthor($id)
    {
        $this->author = Author::findOrFail($id);
        $this->authorId = $this->author->id;
        $this->names = $this->author->names;
        $this->surnames = $this->author->surnames;
        $this->open = true;
    }
    public function save()
    {
        $this->validate();

        $author = Author::findOrFail($this->authorId);
        $author->names = $this->names;
        $author->surnames = $this->surnames;
        $author->save();
    
        $this->alert('success', 'Autor actualizado con éxito');

        
        $this->reset(['names', 'surnames', 'open']);
        $this->dispatch('refreshAuthors');
    }
}
