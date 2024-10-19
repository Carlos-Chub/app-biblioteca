<?php

namespace App\Livewire\Reports;

use App\Exports\CustomOneExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{
    public $estado_libro='all';
    public $fecha_inicio;
    public $fecha_final;


    public function download_report()
    {
        $this->validate([
            'estado_libro' => 'required|in:all,returned,in_use',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_final',
            'fecha_final' => 'required|date',
        ]);

        return Excel::download(new CustomOneExport($this->estado_libro,$this->fecha_inicio,$this->fecha_final), 'reporte-one.xlsx');
    }



    public function render()
    {
        return view('livewire.reports.reports');
    }
}
