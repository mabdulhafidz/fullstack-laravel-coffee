<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'customer_id',
        'description',
        'total_amount',
        'transaction_date'
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function details()
    {
        return $this->hasMany(TransactioDetail::class);
    }


}
