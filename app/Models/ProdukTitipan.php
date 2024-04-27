<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ProdukTitipan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'nama_supplier',
        'harga_beli',
        'harga_jual',
        'stock',
        'keterangan'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
