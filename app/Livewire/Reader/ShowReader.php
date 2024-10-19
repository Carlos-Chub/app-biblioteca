<?php

namespace App\Livewire\Reader;

use App\Models\Reader;
use Carbon\Carbon;
use Livewire\Component;

class ShowReader extends Component
{
    public Reader $reader;
    public $fecha;
    public function mount(Reader $reader)
    {
        $this->reader=$reader;
        $this->fecha=Carbon::createFromFormat('Y-m-d', $this->reader->date_birthday)->format('d-m-Y');
    }

    public function render()
    {
        return view('livewire.reader.show-reader');
    }
}
