<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index');
    }


  // Contoh di dalam controller
public function invoice($id)
{
    try {
        $transaction = Transaction::findOrFail($id);
    } catch (ModelNotFoundException $e) {
       return('error');
       dd($transaction);
    }

    return view('admin.invoice.index', compact('transaction'));
}

    
}
