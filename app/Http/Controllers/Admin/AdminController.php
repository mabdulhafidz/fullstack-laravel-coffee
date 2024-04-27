<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        $transactiondetail = TransactionDetail::all();
        $customer = Customer::all();
        return view('admin.index', compact('transaction', 'transactiondetail', 'customer'));
    }
}
