<?php

namespace App\Livewire\BookReaders;

use App\Models\Book;
use App\Models\BookReader;
use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateBookReader extends Component
{
    use LivewireAlert;

    public $reader;
    public $book;
    public $status = 'pending_assignment';
    public $notifications = [];
    public $return_date;

    public function rules()
    {
        return [
            'reader' => ['required', Rule::exists('readers', 'id')],
            'book' => ['required', Rule::exists('books', 'id')],
            'status' => ['required', Rule::in(['pending_assignment', 'assigned_book', 'returned_book'])],
            'notifications' => ['required', 'array', 'min:1', 'max:3'],
            'notifications.*' => [Rule::in(['sms', 'whatsapp', 'email'])],
            'return_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $fechaIngresada = Carbon::parse($value);
                    $fechaActual = Carbon::now();
                    $fechaLimite = $fechaActual->copy()->addDays(10);
        
                    if ($fechaIngresada->isToday() || $fechaIngresada->lt($fechaActual)) {
                        $fail('La fecha de retorno debe ser mayor que el día de hoy.');
                    }
        
                    if ($fechaIngresada->gt($fechaLimite)) {
                        $fail('La fecha de retorno no puede ser más de 10 días a partir de hoy.');
                    }
                },
            ],
        ];
    }
    public function save()
    {
        $this->validate();
        $data_create=[
            'reader_id'=>$this->reader,
            'book_id'=>$this->book,
            'status'=>$this->status,
            'return_date'=>$this->return_date
        ];
        foreach ($this->notifications as $notification) {
            if ($notification==='sms') {
                $data_create['sms']=true; 
            }
            if ($notification==='whatsapp') {
                $data_create['whatsapp']=true; 
            }
            if ($notification==='email') {
                $data_create['email']=true; 
            }
        }
        $bookReader = BookReader::create($data_create);
        if (!$bookReader) {
            $this->alert('error', __('Book reader not created successfully'));
        }
        $this->flash('success', __('Book reader created successfully'), [], route('book-reader.index'));
    }

    public function render()
    {
        return view('livewire.book-readers.create-book-reader',[
            'readers_all'=> Reader::all(),
            'books_all'=> Book::all()
        ]);
    }
}
