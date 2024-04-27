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
        // $this->authorize('view-any', Transaction::class);
        
        return view('admin.transaction.index');
    }


    // Contoh di dalam controller
    public function invoice($id)
    {
        try {
            $transaction = Transaction::with('transactionDetails')->findOrFail($id);
            // dd($transaction->transactionDetails);
        } catch (ModelNotFoundException $e) {
            return ('error');
        }

        return view('admin.invoice.index', compact('transaction'));
    }
}
