<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\BookReader;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    public $book_export;

    public function __construct($book_export)
    {
        $this->book_export = $book_export;
    }

    public function headings(): array
    {
        return [
            'Identificador libro',
            'Titulo',
            'Author',
            'Paginas',
            'Estanteria',
            'Fila',
            'Fecha de registro',
        ];
    }

    public function collection()
    {
        return Book::with(['author:id,names,surnames'])
            ->select('uuid', 'title', 'author_id', 'pages', 'book_case', 'row', 'created_at')
            ->whereIn('id', $this->book_export)
            ->get()
            ->map(function ($book) {
                return [
                    'uuid' => $book->uuid,
                    'title' => $book->title,
                    'author_id' => $book->author->names . ' ' . $book->author->surnames ?? null,
                    'pages' => $book->pages,
                    'book_case' => $book->book_case,
                    'row' => $book->row,
                    'created_at' => $book->created_at
                ];
            });
    }
}
