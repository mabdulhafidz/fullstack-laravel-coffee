<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_menu');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'type_menu');
    }

    public function stocks()
    {
        return $this->hasOne(Stock::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
