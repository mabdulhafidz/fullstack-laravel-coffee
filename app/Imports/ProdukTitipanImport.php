<?php

namespace App\Imports;

use App\Models\ProdukTitipan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukTitipanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ProdukTitipan([
            'nama_produk' => $row['nama_produk'],
            'nama_supplier' => $row['nama_supplier'],
            'harga_beli' => $row['harga_beli'],
            'harga_jual' => $row['harga_jual'],
            'stock' => $row['stock'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}
