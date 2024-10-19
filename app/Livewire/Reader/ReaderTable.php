<?php

namespace App\Livewire\Reader;

use App\Exports\ReadersExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Reader;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class ReaderTable extends DataTableComponent
{
    protected $model = Reader::class;

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
        $readers_export = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new ReadersExport($readers_export), 'readers.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Uuid", "uuid")
                ->sortable(),
            Column::make(__("Names"), "names")
                ->sortable()
                ->searchable(),
            Column::make(__("Surnames"), "surnames")
                ->sortable()
                ->searchable(),
            Column::make(__("Date birthday"), "date_birthday")
            ->collapseAlways(),
            Column::make(__("Phone"), "phone")
                ->sortable()
                ->searchable(),
            Column::make(__("Address"), "address")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make(__("Email"), "email")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make(__('Actions'), "id")
                ->view('livewire.reader.partials.actions-datatable'),
        ];
    }
    
    #[On('readers_viewtable')]
    public function refreshTable()
    {
        $this->builder();
    }
}