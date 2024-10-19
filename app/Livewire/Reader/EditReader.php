<?php

namespace App\Livewire\Reader;

use App\Models\Reader;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditReader extends Component
{
    use LivewireAlert;

    public Reader $reader;
    public $names;
    public $surnames;
    public $date_birthday;
    public $phone;
    public $email;
    public $address;

    public function mount(Reader $reader)
    {
        if ($reader->id) {
            $this->reader = $reader;
            $this->names = $this->reader->names;
            $this->surnames = $this->reader->surnames;
            $this->date_birthday = $this->reader->date_birthday;
            $this->phone = substr($this->reader->phone, 4);
            $this->email = $this->reader->email;
            $this->address = $this->reader->address;
        }
    }

    public function rules()
    {
        return [
            'names' => 'required|max:255|string',
            'surnames' => 'required|max:255|string',
            'date_birthday' => ['required', 'date', 'before:today'],
            'phone' => 'required|min:8|max:8|string',
            'email' => 'nullable|email|max:255|string',
            'address' => 'required|max:255|string',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        $reader = $this->reader->update($validated);
        if (!$reader) {
            $this->alert('error', __('Reader not updated successfully'));
        }
        $this->flash('success', __('Reader updated successfully'), [], route('reader.index'));
    }

    public function render()
    {
        return view('livewire.reader.edit-reader');
    }
}
