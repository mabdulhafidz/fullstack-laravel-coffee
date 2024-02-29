<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index');
    }
    public function invoice($id)
    {
       $transaction = Transaction::findOrFail($id);
//    dd($transaction);
        return view('admin.invoice.index', compact('transaction'));
    }
}
