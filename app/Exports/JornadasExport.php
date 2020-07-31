<?php

namespace App\Exports;

use App\Models\JornadaActividad;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JornadasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Id',
            'Hora Inicio',
            'Hora Fin',
        ];
    }

    public function collection()
    {
        $consulta = DB::select('select id, hora_inicio, hora_fin from jornada_actividades');

        return collect($consulta);
    }
}
