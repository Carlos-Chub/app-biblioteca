<?php

namespace App\Livewire\Authors;

use App\Exports\AuthorExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Author;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Columns\WireLinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class AuthorTable extends DataTableComponent
{
    use LivewireAlert;
    protected $model = Author::class;
    protected $listeners = ['refreshAuthors' => 'columns'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Exportar',
        ];
    }

    public function export()
    {
        $author_export = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new AuthorExport($author_export), 'authors.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombres", "names")
                ->sortable()->searchable(),
            Column::make("Apellidos", "surnames")
                ->sortable()->searchable(),
            Column::make("Creacion", "created_at")
                ->sortable(),
            Column::make("Actualizacion", "updated_at")
                ->sortable(),
            Column::make(__('Actions'), "id")
                ->view('livewire.authors.actions'),


        ];
    }
    public function filters(): array
    {
        return [
            DateFilter::make('Fecha Creacion', 'created_at'),
        ];
    }

    public function editar($id)
    {
        $this->dispatch('editauthor', id: $id);
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        $this->alert('success', '¡El autor ha sido eliminado!');
    }
}
