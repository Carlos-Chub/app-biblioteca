<?php

namespace App\Livewire\Reader;

use App\Models\Reader as ModelsReader;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Reader extends Component
{
    use LivewireAlert;
    
    public $showDeleteModal = false;
    public $DeleteSelected = 0;
    public $DeleteName = '';

    #[On('showModalDeleteReader')]
    public function showModal($id, $name)
    {
        $this->showDeleteModal = true;
        $this->DeleteSelected = $id;
        $this->DeleteName = $name;
    }

    public function delete($id)
    {
        $reader = ModelsReader::findOrFail($id);
        $result = $reader->delete();
        if ($result) {
            $this->showDeleteModal = false;
            $this->alert('success', __('Reader deleted successfully'));
            $this->dispatch('readers_viewtable');
            return;
        } else {
            $this->showDeleteModal = false;
            $this->alert('error', __('Reader not deleted successfully'));
            return;
        }
    }
    public function render()
    {
        return view('livewire.reader.reader');
    }
}
