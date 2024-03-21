<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $transaction = Transaction::with('transactionDetails')->get();
        } catch (ModelNotFoundException $e) {
            return view('error', ['message' => 'Error fetching transactions.']);
        }
    
        return view('admin.laporan.index', compact('transaction'));
    }
}    
