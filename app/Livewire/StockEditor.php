<?php

namespace App\Livewire;

use App\Models\ProdukTitipan;
use Livewire\Component;

class StockEditor extends Component
{
    public $stock;
    public $itemId;

    public function mount($itemId, $stock)
    {
        $this->itemId = $itemId;
        $this->stock = $stock;
    }

    public function updateStock()
    {
        $item = ProdukTitipan::find($this->itemId);
        $item->stock = $this->stock;
        $item->save();
    
        $this->dispatch('stockUpdated');
    }
    

    public function render()
    {
        return view('livewire.stock-editor');
    }
}
