<?php

namespace App\Livewire\BookReaders;

use App\Models\BookReader as ModelsBookReader;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class BookReader extends Component
{
    use LivewireAlert;
    
    public $showDeleteModal = false;
    public $DeleteSelected = 0;

    #[On('showModalDeleteBookReader')]
    public function showModal($id)
    {
        $this->showDeleteModal = true;
        $this->DeleteSelected = $id;
    }

    public function delete($id)
    {
        $bookReader = ModelsBookReader::findOrFail($id);
        $result = $bookReader->delete();
        if ($result) {
            $this->showDeleteModal = false;
            $this->alert('success', __('Book reader deleted successfully'));
            $this->dispatch('book_readers_viewtable');
            return;
        } else {
            $this->showDeleteModal = false;
            $this->alert('error', __('Book reader not deleted successfully'));
            return;
        }
    }

    public function render()
    {
        return view('livewire.book-readers.book-reader');
    }
}
