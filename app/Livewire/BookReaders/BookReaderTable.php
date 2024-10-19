<?php

namespace App\Livewire\BookReaders;

use App\Exports\BookReadersExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BookReader;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class BookReaderTable extends DataTableComponent
{
    protected $model = BookReader::class;

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
        $book_readers_export = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new BookReadersExport($book_readers_export), 'book_readers.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__("Reader"), "reader.names")
                ->sortable()
                ->searchable(),
            Column::make(__("Book"), "book.title")
                ->sortable()
                ->searchable(),
            Column::make(__("Status"), "status")
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row, Column $column)  => __($value)
                )
                ->html(),
            Column::make("Sms", "sms")
                ->sortable()
                ->collapseAlways()
                ->format(
                    fn($value, $row, Column $column)  => $value ? __('Aplica') : __('No aplica')
                )
                ->html(),
            Column::make("Whatsapp", "whatsapp")
                ->sortable()
                ->collapseAlways()
                ->format(
                    fn($value, $row, Column $column)  => $value ? __('Aplica') : __('No aplica')
                )
                ->html(),
            Column::make(__("Email"), "email")
                ->sortable()
                ->collapseAlways()
                ->format(
                    fn($value, $row, Column $column)  => $value ? __('Aplica') : __('No aplica')
                )
                ->html(),
            Column::make(__("Return date"), "return_date")
                ->sortable()
                ->searchable(),
            Column::make(__('Actions'), "id")
                ->view('livewire.book-readers.partials.actions-datatable'),
        ];
    }

    #[On('book_readers_viewtable')]
    public function refreshTable()
    {
        $this->builder();
    }
}
