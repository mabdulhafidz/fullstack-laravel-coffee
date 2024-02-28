<?php

namespace App\Livewire\Transaksi;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Transaction;
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
    use LivewireAlert;

    public function select($categoryId)
    {
        $this->select = $categoryId;
    }

    public function render()
    {
        $menus = Menu::all(); 
        $categories = Category::all();
        $menus = $this->Category
    ? Menu::find($this->Category)
    : Menu::all();


        // dd($categories, $menus);
    
        $customers = Customer::all();
        $employees = Employee::all();
        $stocks = Stock::all();
        $categories = Category::all();
        

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
    
        $this->cart = [];
        $this->subtotal =   0;
        $this->unitPrice =   0;
    
        DB::commit();
    
        $this->confirm('Print Nota', [
            'position' => 'center',
            'toast' => true,
            'timer' => null,
            'width' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Confirm',
        ]);
    }
    
    public function confirmed()
    {
        return redirect()->route('admin.transaction.index');
    }

    public function Toinvoice()
    {
        
    }
    
    
    
}
