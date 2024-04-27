<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class AbsensiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Validasi data sebelum menyimpan ke database
        $validator = FacadesValidator::make($row, [
            'namaKaryawan' => 'required',
            'tanggalMasuk' => 'required|date',
            'waktuMasuk' => 'required',
            'status' => 'required',
            'waktuKeluar' => 'required'
        ]);
    
        if ($validator->fails()) {
            return null;
        }
        DB::beginTransaction();
    
        try {
            $absensi = new Absensi([
                'namaKaryawan' => $row['namaKaryawan'],
                'tanggalMasuk' => $row['tanggalMasuk'],
                'waktuMasuk' => $row['waktuMasuk'],
                'status' => $row['status'],
                'waktuKeluar' => $row['waktuKeluar'],
            ]);
    
            // Simpan model ke database
            $absensi->save();
    
            // Commit transaksi jika berhasil
            DB::commit();
    
            // Kembalikan model Absensi yang berhasil disimpan
            return $absensi;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
    
            // Tangani kesalahan dengan memberikan pesan atau melakukan logging
            return null;
        }
    }
    
}
