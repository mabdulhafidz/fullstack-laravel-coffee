<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function index() 
    {
        $menus = Menu::all();
        $transaction = Transaction::all();
        $Transactiondetail = TransactionDetail::all();

        return view('admin.detailTransaction.index', compact('menus', 'transaction', 'Transactiondetail'));
    }
}
