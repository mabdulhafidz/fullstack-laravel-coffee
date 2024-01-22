<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'keterangan',
        'total_harga',
        'tanggal',
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }


}
