<?php

namespace App\Livewire\Laporan;

use Livewire\Component;
use App\Models\Transaction;

class Index extends Component
{
    public $filter = 'December 2023';
    public $transaction;

    public function mount()
    {
        $this->transaction = Transaction::all();
    }

    public function render()
    {
        return view('livewire.laporan.index');
    }

    public function updatedFilter()
    {
        if ($this->filter === 'Last 7 Days') {
            $this->transaction = Transaction::whereDate('transaction_date', '>=', now()->subDays(7))->get();
        } else {
            $this->transaction = Transaction::all();
        }
    }
}
