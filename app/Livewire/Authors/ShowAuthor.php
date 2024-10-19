<?php

namespace App\Livewire\Authors;

use Livewire\Component;
use App\Models\Author;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class ShowAuthor extends Component
{
    use LivewireAlert;
    public $showDeleteModal = false;
    public $DeleteSelected = 0;
    public $DeleteName = '';

    #[On('showModalDeleteAuthor')]
    public function showModal($id, $name)
    {
        $this->showDeleteModal = true;
        $this->DeleteSelected = $id;
        $this->DeleteName = $name;
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id);
        $result = $author->delete();
        if ($result) {
            $this->showDeleteModal = false;
            $this->alert('success', __('Author deleted successfully'));
            $this->dispatch('refreshAuthors');
            return;
        } else {
            $this->showDeleteModal = false;
            $this->alert('error', __('Author not deleted successfully'));
            return;
        }
    }
    public function render()
    {
        return view('livewire.authors.show-author');
    }
}
