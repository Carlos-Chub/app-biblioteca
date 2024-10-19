<?php

namespace App\Exports;

use App\Models\BookReader;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomOneExport implements FromCollection, WithHeadings
{
    public $estado_libro;
    public $fecha_inicio;
    public $fecha_final;

    public function __construct($estado_libro, $fecha_inicio, $fecha_final)
    {
        $this->estado_libro = $estado_libro;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
    }

    public function headings(): array
    {
        return [
            'Identificador',
            'Nombres',
            'Apellidos',
            'Telefono',
            'Direccion',
            'Titulo libro',
            'Paginas',
            'Estante',
            'Fila',
            'Estado prestamo libro',
            'Fecha de devolución',
            'Fecha de prestamo',
            'SMS',
            'WhatsApp',
            'Email',
        ];
    }

    public function collection()
    {
        $query = BookReader::with(['book:id,title,pages,book_case,row', 'reader:id,names,surnames,phone,address'])
            ->select('id', 'status', 'book_id', 'reader_id', 'return_date', 'sms', 'whatsapp', 'email','created_at');

        // Filtrar por estado si no es 'all'
        if ($this->estado_libro !== 'all') {
            if ($this->estado_libro=='in_use') {
                $this->estado_libro='in use';
            }
            $query->where('status', $this->estado_libro);
        }

        // Filtrar por fecha de devolución
        if ($this->fecha_inicio && $this->fecha_final) {
            $query->whereBetween('return_date', [$this->fecha_inicio, $this->fecha_final]);
        }

        return $query->get()->map(function ($bookReader) {
            return [
                'id' => $bookReader->id,
                'names' => $bookReader->reader->names ?? null,
                'surnames' => $bookReader->reader->surnames ?? null,
                'phone' => $bookReader->reader->phone ?? null,
                'address' => $bookReader->reader->address ?? null,
                'book_title' => $bookReader->book->title ?? null,
                'book_pages' => $bookReader->book->pages ?? null,
                'book_case' => $bookReader->book->book_case ?? null,
                'book_row' => $bookReader->book->row ?? null,
                'status' => $bookReader->status,
                'return_date' => $bookReader->return_date,
                'created_at' => $bookReader->created_at,
                'sms' => $bookReader->sms ? 'Aplica' : 'No Aplica',
                'whatsapp' => $bookReader->whatsapp ? 'Aplica' : 'No Aplica',
                'email' => $bookReader->email ? 'Aplica' : 'No Aplica',
            ];
        });
    }
}
