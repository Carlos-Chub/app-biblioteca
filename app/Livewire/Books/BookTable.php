<?php

namespace App\Livewire\Books;

use App\Exports\BookExport;
use App\Models\Author;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Columns\WireLinkColumn;

class BookTable extends DataTableComponent
{
    use LivewireAlert;
    protected $listeners = ['refreshBooks' => 'columns'];
    protected $model = Book::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Exportar',
        ];
    }

    public function export()
    {
        $book_export = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new BookExport($book_export), 'books.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Uiid", "uuid")
                ->sortable()->searchable()->collapseAlways(),
            Column::make("Titulo", "title")
                ->sortable()->searchable(),
            Column::make("Autor", "author.names")
                ->sortable(function ($query, $direction) {
                    return $query->orderBy(Author::select('names')
                        ->whereColumn('authors.id', 'books.author_id'), $direction);
                })->searchable(),
            Column::make("Paginas", "pages")
                ->sortable(),
            Column::make("Estante", "book_case")
                ->sortable()->collapseAlways(),
            Column::make("Fila", "row")
                ->sortable()->collapseAlways(),
            Column::make(__('Actions'), "id")
                ->view('livewire.books.actions'),
        ];
    }
}
