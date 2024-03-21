<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categories_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'type_category');
    }
}
