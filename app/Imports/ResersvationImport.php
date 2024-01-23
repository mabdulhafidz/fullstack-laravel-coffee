<?php

namespace App\Imports;

use App\Models\Resersvation;
use Maatwebsite\Excel\Concerns\ToModel;

class ResersvationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Resersvation([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'tel_number' => $row['tel_number'],
            'email' => $row['email'],
            'table_id' => $row['table_id'],
            'res_date' => $row['res_date'],
            'guest_number' => $row['guest_number'],
        ]);
    }
}
