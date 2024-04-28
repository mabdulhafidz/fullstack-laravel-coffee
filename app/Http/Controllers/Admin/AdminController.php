<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        $transactiondetail = TransactionDetail::all();
        $menuCount = Menu::count();
        $customers = User::whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();

        $customerCount = $customers->count();

        // Menghitung jumlah menu minggu lalu
        $lastWeekMenuCount = Menu::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek(),
        ])->count();

        $percentageChange = 0;
        if ($lastWeekMenuCount > 0) {
            $percentageChange = ($menuCount - $lastWeekMenuCount) / $lastWeekMenuCount * 100;
        }

        return view('admin.index', compact('transaction', 'transactiondetail', 'customerCount', 'menuCount', 'percentageChange'));
    }
}