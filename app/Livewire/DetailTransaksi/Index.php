<?php

namespace App\Livewire\DetailTransaksi;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $menus = Menu::all();
        $transaction = Transaction::all();
        $Transactiondetail = TransactionDetail::all();

        return view('livewire.detail-transaksi.index', compact('menus', 'transaction', 'Transactiondetail'));
    }
}
