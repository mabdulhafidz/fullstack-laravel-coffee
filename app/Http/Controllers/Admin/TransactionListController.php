<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Resersvation;
use App\Models\Table;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionListController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        $Transactiondetail = TransactionDetail::all();
        $customer = Customer::all();
        $tables = Table::all();
        $resersvation = Resersvation::all();
        return view('admin.transactionlist.index', compact('transaction', 'Transactiondetail', 'customer', 'tables', 'resersvation'));
    }
}
