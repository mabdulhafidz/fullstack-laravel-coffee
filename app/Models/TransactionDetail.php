<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'menu_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transaction()
    {
    return $this->belongsTo(Transaction::class);
    }

    public function stocks()
    {
    return $this->hasOne(Stock::class);
    }

    public function produktitipan()
    {
        return $this->belongsTo(ProdukTitipan::class, 'produktitipan_id');
    }
}
