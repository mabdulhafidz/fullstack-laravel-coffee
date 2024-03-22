<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaKaryawan',
        'tanggalMasuk',
        'waktuMasuk',
        'status',
        'waktuKeluar',
    ];

    public function getShiftEndStatusAttribute()
    {
        $currentTime = Carbon::now();
        $shiftEndTime = $this->waktuKeluar->addHours(7);

        if ($currentTime->gt($shiftEndTime)) {
            return 'Selesai';
        }

        return null;
    }
}
