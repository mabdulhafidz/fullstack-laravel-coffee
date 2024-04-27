<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telp'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
