<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'total_harga' => $request->input('total_harga'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
