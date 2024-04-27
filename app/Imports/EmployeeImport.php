<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'nip' => $row['nip'],
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Default Value',
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'telpon' => $row['telpon'] ?? 'Default Value',
            'agama' => $row['agama'],
            'status_nikah' => $row['status_nikah'],
            'alamat' => $row['alamat'],
            'image' => $row['image'],
        ]);
        
    }
}
