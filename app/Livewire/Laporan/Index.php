<?php

namespace App\Livewire\Laporan;

use Livewire\Component;
use App\Models\Transaction;

class Index extends Component
{
    public $start_date, $end_date;
    public $data_laporan = [];
    public $total_pendapatan = 0;


    public function getLaporan()
    {
        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
        ]);
    
        $data_laporan = Transaction::with('transactionDetails')
            ->whereBetween('transaction_date', [$this->start_date, $this->end_date]);
    
        $this->data_laporan = $data_laporan->get();
        $this->total_pendapatan = $data_laporan->sum('total_amount');
    }
    
    

    public function render()
    {
        return view('livewire.laporan.index');
    }

}
