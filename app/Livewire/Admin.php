<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class Admin extends Component
{
    public $mostOrderedMenuCount;
    public $remainingStock;
    public $totalRevenue;
    public $filterDate;
    public $transactionCount;
    public $customer;
    public $menu;
    public $chartData;
    public $lowStockItems;
    public $mostOrderedMenus;
    public $revenueData = [];
    public $transaction_date;
    public $transactions;
    public $customers;

    public function mount()
    {
        $this->filterDate = now()->format('Y-m-d');
        // $this->calculateTotalRevenue();
        $this->totalRevenue = Transaction::sum('total_amount');
        $this->transactionCount = Transaction::count();
        $this->customer = Customer::count();
        $this->menu = Menu::count();
        $transactions = Transaction::all();
        $this->customers = Customer::all();

        $this->lowStockItems = Stock::orderBy('jumlah')
        ->with('menu')
        ->take(5)
        ->get();
    

        $this->chartData = [10, 20, 30, 40, 50];

        $menuOrders = [];

        // Mengambil semua detail transaksi
        $transactionDetails = TransactionDetail::all();

        // Menghitung jumlah pemesanan untuk setiap menu
        foreach ($transactionDetails as $detail) {
            $menuId = $detail->menu_id;
            if (array_key_exists($menuId, $menuOrders)) {
                $menuOrders[$menuId]['quantity'] += $detail->quantity;
            } else {
                $menu = Menu::find($menuId);
                $menuOrders[$menuId] = [
                    'quantity' => $detail->quantity,
                    'menu' => $menu,
                ];
            }
        }

        arsort($menuOrders);

        $this->mostOrderedMenus = array_slice($menuOrders, 0, 5);
        $groupedTransactions = $transactions->groupBy(function($transaction) {
            $transactionDate = Carbon::createFromFormat('Y-m-d', $transaction->transaction_date);
            return $transactionDate->format('Y-m-d');
        });

        // Hitung total pendapatan untuk setiap tanggal
        $groupedTransactions = Transaction::all()->groupBy(function($transaction) {
            return Carbon::parse($transaction->transaction_date)->format('Y-m-d');
        });

        $totalRevenue = Transaction::sum('total_amount');

        foreach ($groupedTransactions as $date => $transactions) {
            $dailyRevenue = $transactions->sum('total_amount');
            $percentage = ($dailyRevenue / $totalRevenue) * 100;

            $this->revenueData[] = [
                'date' => $date,
                'revenue' => $dailyRevenue,
                'percentage' => round($percentage, 2) // Round to 2 decimal places
            ];
        }
    }
    
    public function render()
    {
        return view('livewire.admin', [
            'transactions' => $this->transactions,
        ]);
    }

    public function updatedFilterDateAttribute()
    {
        $this->totalRevenue = Transaction::whereDate('transaction_date', $this->filterDate)->sum('total_amount');
    }
    
    public function getTransactions()
    {
        return $this->filterDate
            ? Transaction::whereDate('transaction_date', $this->filterDate)->get()
            : Transaction::all();
    }
}
