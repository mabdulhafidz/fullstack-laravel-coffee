<?php

namespace App\Imports;

use App\Models\Table;
use Maatwebsite\Excel\Concerns\ToModel;

class TableImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Table([
            'name' => $row['name'],
            'guest_number' => $row['guest_number'],
            'status' => $row['status'],
            'location' => $row['location'],
        ]);
    }
}
