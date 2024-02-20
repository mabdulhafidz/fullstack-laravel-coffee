<?php

namespace App\Livewire\Transaksi;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Stock;
use Livewire\Component;

class Index extends Component
{

    public $cart = [];
    public $totalPrice =  0;
    public $itemCount =  0;
    public $selectedCategory;


    public function render()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $customers = Customer::all();
        $employees = Employee::all();
        $stocks = Stock::all();
        $categories = Category::all();

        $menus = Menu::when($this->selectedCategory, function ($query) {
            return $query->where('category_id', $this->selectedCategory);
        })->get();
        
        return view('livewire.transaksi.index', compact('menus', 'categories', 'employees', 'stocks'));
    }

    public function addToCart($menuId, $menuName, $price, $quantity =  1)
    {
        $stock = Stock::where('menu_id', $menuId)->first();
    
       
        if ($stock && $stock->jumlah >= $quantity) {
            $stock->decrement('jumlah', $quantity);
    
            if (array_key_exists($menuId, $this->cart)) {
              
                $this->cart[$menuId]['qty'] += $quantity;
            } else {
                $this->cart[$menuId] = [
                    'id' => $menuId,
                    'name' => $menuName,
                    'price' => $price,
                    'stock' => $stock,
                    'qty' => $quantity,
                ];
            }
    
            $this->totalPrice += $price * $quantity;
            $this->itemCount += $quantity;
    
        } else {
            $this->handleStockEmpty($menuName);
        }
    }
    

    public function handleStockEmpty($menuName)
    {
        $this->addError('stockEmpty', "$menuName Sold Out.");
    }



    public function removeFromCart($menuId)
    {
    if (array_key_exists($menuId, $this->cart)) {
     
        $price = $this->cart[$menuId]['price'];
        $qty = $this->cart[$menuId]['qty'];
        unset($this->cart[$menuId]);

        $this->totalPrice -= $price * $qty;
        $this->itemCount -= $qty;

        $this->restoreStock($menuId, $qty);
    }
    }

    private function restoreStock($menuId, $quantity)
    {
        $stock = Stock::where('menu_id', $menuId)->first();

        if ($stock) {
            $stock->increment('jumlah', $quantity);
        }
    }

    public function updateCart($menuId, $qty)
    {
        if (array_key_exists($menuId, $this->cart)) {
        $price = $this->cart[$menuId]['price'];
        $oldQty = $this->cart[$menuId]['qty'];
        $this->cart[$menuId]['qty'] = $qty;

        $this->totalPrice = $this->totalPrice - $price * $oldQty + $price * $qty;
        $this->itemCount += $qty - $oldQty;
    }
}

    public function calculateCart()
    {
        $this->totalPrice =  0;
        $this->itemCount =  0;
        foreach ($this->cart as $item) {
            $this->totalPrice += $item['price'] * $item['qty'];
            $this->itemCount += $item['qty'];
        }
    }
}
