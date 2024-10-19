<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowBook extends Component
{
    use LivewireAlert;
    public $showDeleteModal = false;
    public $DeleteSelected = 0;
    public $DeleteName = '';

    #[On('showModalDeleteBook')]
    public function showModal($id, $name)
    {
        $this->showDeleteModal = true;
        $this->DeleteSelected = $id;
        $this->DeleteName = $name;
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $result = $book->delete();
        if ($result) {
            $this->showDeleteModal = false;
            $this->alert('success', __('Book deleted successfully'));
            $this->dispatch('refreshBooks');
            return;
        } else {
            $this->showDeleteModal = false;
            $this->alert('error', __('Book not deleted successfully'));
            return;
        }
    }
    public function render()
    {
        return view('livewire.books.showbook');
    }
}
