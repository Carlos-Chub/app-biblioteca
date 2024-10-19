<?php

namespace App\Livewire\Reader;

use App\Models\Reader;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateReader extends Component
{
    use LivewireAlert;

    public $names;
    public $surnames;
    public $date_birthday;
    public $phone;
    public $email;
    public $address;

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
    public function save() {
        $validated= $this->validate();
        $reader = Reader::create($validated);
        if (!$reader) {
            $this->alert('error', __('Reader not created successfully'));
        }
        $this->flash('success', __('Reader created successfully'), [], route('reader.index'));
    }

    public function render()
    {
        return view('livewire.reader.create-reader');
    }
}
