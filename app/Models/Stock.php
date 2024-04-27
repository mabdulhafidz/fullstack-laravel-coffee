<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'menu_id'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
