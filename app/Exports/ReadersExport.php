<?php
 
namespace App\Exports;

use App\Models\Reader;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReadersExport implements FromCollection, WithHeadings
{
    public $readers_export;
 
    public function __construct($readers_export) {
        $this->readers_export = $readers_export;
    }

    public function headings(): array
    {
        return [
            'Identificador lector',
            'Nombres',
            'Apellidos',
            'Fecha nacimiento',
            'Número de telefono',
            'Dirección',
            'Correo',
            'Fecha de registro',
            'Email',
        ];
    }
 
    public function collection()
    {
        return Reader::select('uuid', 'names', 'surnames', 'date_birthday','phone','address','email','created_at')
        ->whereIn('id', $this->readers_export)
        ->get();
    }
}