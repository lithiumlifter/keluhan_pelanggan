<?php

namespace App\Exports;

use App\Models\KeluhanPelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeluhanPelangganExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KeluhanPelanggan::all()->map(function($keluhan){
            switch ($keluhan->status_keluhan) {
                case 0:
                    $keluhan->status_keluhan = 'Received';
                    break;
                case 1:
                    $keluhan->status_keluhan = 'In Process';
                    break;
                case 2:
                    $keluhan->status_keluhan = 'Done';
                    break;
            }
            return $keluhan;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'No Hp',
            'Status Keluhan',
            'Keluhan',
            'Created At',
            'Updated At'
        ];
    }
}
