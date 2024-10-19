<?php
 
namespace App\Exports;

use App\Models\Author;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuthorExport implements FromCollection, WithHeadings
{
    public $author_export;
 
    public function __construct($author_export) {
        $this->author_export = $author_export;
    }

    public function headings(): array
    {
        return [
            'Identificador',
            'Nombres',
            'Apellidos',
            'Fecha de registro',
        ];
    }
 
    public function collection()
    {
        return Author::select('id', 'names', 'surnames', 'created_at')
        ->whereIn('id', $this->author_export)
        ->get();
    }
}