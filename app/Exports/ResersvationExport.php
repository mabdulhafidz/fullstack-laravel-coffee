<?php

namespace App\Exports;

use App\Models\Resersvation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResersvationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resersvation::all();
    }
}
