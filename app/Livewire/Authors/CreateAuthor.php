<?php

namespace App\Livewire\Authors;

use App\Models\Author;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateAuthor extends Component
{
    use LivewireAlert;

    public $open = false;
    public $names, $surnames;

    protected $rules = [
        'names' => 'required|string|min:3', // 'names' es obligatorio y debe tener al menos 3 caracteres
        'surnames' => 'nullable|string',
    ];

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);
    // }

    public function save()
    {
        $this->validate();

        Author::create([
            'names' => $this->names,
            'surnames' => $this->surnames,
        ]);
        $this->alert('success', '¡El autor ha sido creado exitosamente!');

        $this->dispatch('refreshAuthors');
        $this->reset(['names', 'surnames', 'open']);
    }
    public function render()
    {
        return view('livewire.authors.createauthor');
    }
}
