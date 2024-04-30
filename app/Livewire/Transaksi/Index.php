<?php

namespace App\Livewire\Transaksi;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Index extends Component
{

    public $cart = [];
    public $alerts = [];
    public $subtotal =  0;
    public $unitPrice =  0;
    public $Category;
    public $totalAmount =  0;
    public $transactionDate;
    public $description;
    public $updateStock;
    public $query;
    public $searchTerm;
    public $select;
    public $alert;
    public $transaction_id;
    public $transactions;
    public $c;
    public $selectedCategory;
    public $m;

    use LivewireAlert;

    public function mount()
    {
        $this->c = Category::all();
    }

    public function select($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadMenus();
    }

    public function loadMenus()
    {
        if ($this->selectedCategory) {
            $this->m = Menu::whereHas('categories', function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })->get();
        } else {
            $this->m = Menu::all();
        }
    }
    public function render()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $menus = $this->Category
            ? Menu::find($this->Category)
            : Menu::all();

        $customers = Customer::all();
        $employees = Employee::all();
        $stocks = Stock::all();
        $categories = Category::all();

        $transactionDetail = $this->transaction_id
            ? Transaction::findOrFail($this->transaction_id)->transactionDetail
            : collect();

        return view('livewire.transaksi.index', compact('menus', 'categories', 'employees', 'stocks', 'transactionDetail'));
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
    
            $this->subtotal += $price * $quantity;
            $this->unitPrice += $quantity;
    
        } else {
            $this->handleStockEmpty($menuName);
        }
    }

    
    public function selectCategory($categoryId)
    {
        $this->Category = $categoryId;
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

        $this->subtotal -= $price * $qty;
        $this->unitPrice -= $qty;

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

        $this->subtotal = $this->subtotal - $price * $oldQty + $price * $qty;
        $this->unitPrice += $qty - $oldQty;
    }
}

    public function calculateCart()
    {
        $this->subtotal =  0;
        $this->unitPrice =  0;
        foreach ($this->cart as $item) {
            $this->subtotal += $item['price'] * $item['qty'];
            $this->unitPrice += $item['qty'];
        }
    }
    
    public function submit()
    {
        DB::beginTransaction();

        $transaction = Transaction::create([
            'total_amount' => $this->subtotal,   
            'description' => $this->description ?? 'No description provided',
            'transaction_date' => now(),
        ]);

        $this->transaction_id = $transaction->id;

        foreach ($this->cart as $item) {    
            $isTipped = isset($item['tipped']) && $item['tipped'];
        
            if ($isTipped) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => null,
                    'produktitipan_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);
            } else {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['id'], 
                    'produktitipan_id' => null,
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);
            }
        }
        

        $this->cart = [];
        $this->subtotal = 0;
        $this->unitPrice = 0;

        DB::commit();

        $this->confirm('Transaction Successfully!', [
            'position' => 'center',
            'toast' => true,
            'timer' => null,
            'width' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'Invoiceshow',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Confirm',
        ]);
    }   

   

}