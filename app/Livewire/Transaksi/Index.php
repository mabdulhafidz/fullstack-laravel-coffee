<?php

namespace App\Livewire\Transaksi;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{

    public $cart = [];
    public $totalPrice =  0;
    public $itemCount =  0;
    public $selectedCategory;
    public $categories;
    public $totalAmount =  0;
    public $transactionDate;
    public $description;
    public $updateStock;



    public function render()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $customers = Customer::all();
        $employees = Employee::all();
        $stocks = Stock::all();
        $categories = Category::all();

        $menus = $this->selectedCategory
        ? Menu::where('category_id', $this->selectedCategory)->get()
        : Menu::all();
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

    
    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
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

    public function updateStock()
    {
        
    }


    public function submit()
    {
        DB::beginTransaction();

        $transaction = Transaction::create([
            'total_amount' => $this->totalPrice,   
            'description' =>  $this->description = $this->description ?? 'No description provided',
            'transaction_date' => $this->transactionDate = now(),
        ]);

        $this->cart = [];
        $this->totalPrice =   0;
        $this->itemCount =   0;

        DB::commit();
    
        session()->flash('message', 'Order submitted successfully.');
        return redirect()->route('admin.transaction.index');
    }
    
    
    
    

}
