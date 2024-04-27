<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
