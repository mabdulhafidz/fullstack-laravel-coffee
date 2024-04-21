<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionList;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Resersvation;
use App\Models\Table;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class TransactionListController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::all();
        $transaction = Transaction::all();
        $tables = Table::all();
        $resersvation = Resersvation::all();
        $Transactiondetail = TransactionDetail::all(); // Mengambil semua detail transaksi
        
        // Jika pencarian berdasarkan tanggal dilakukan
        if ($request->has('transaction_date')) {
            $transactionDate = $request->input('transaction_date');
            // Ambil data transaksi berdasarkan tanggal
            $Transactiondetail = TransactionDetail::whereHas('transaction', function($query) use ($transactionDate) {
                $query->whereDate('transaction_date', $transactionDate);
            })->get();
        }

        return view('admin.transactionlist.index', compact('Transactiondetail', 'transaction', 'customer', 'tables', 'resersvation'));
    }


    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $Transactiondetail = TransactionDetail::where('transaction_id', $id)->get(); // Menampilkan detail transaksi yang terkait dengan transaksi tersebut
        $customer = Customer::findOrFail($transaction->customer_id); // Mengambil informasi pelanggan yang terkait dengan transaksi
        $table = Table::findOrFail($transaction->table_id); // Mengambil informasi meja yang terkait dengan transaksi
        $resersvation = Resersvation::findOrFail($transaction->reservation_id); // Mengambil informasi reservasi yang terkait dengan transaksi (jika ada)
    
        return view('admin.transactionlist.show', compact('transaction', 'Transactiondetail', 'customer', 'table', 'resersvation'));
    }
    

    public function search(Request $request)
{
    $transactionDate = $request->input('transaction_date');

    $transaction = Transaction::whereDate('transaction_date', $transactionDate)->get();

    return view('transactionlist.index', ['transaction' => $transaction]);
}

public function export() 
{
    try {
        return FacadesExcel::download(new TransactionList, 'transactionlist.xlsx');
    } catch (\Exception $e) {
        // dd($e->getMessage());
    }
}


}
