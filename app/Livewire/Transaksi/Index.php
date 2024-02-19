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
    public function render()
    {
       $menus = Menu::all();
       $categories = Category::all();
       $customers = Customer::all();
       $employees = Employee::all();
       $stocks = Stock::all();
        return view('livewire.transaksi.index', compact('menus','categories', 'employees', 'stocks'));
    }
    
}
