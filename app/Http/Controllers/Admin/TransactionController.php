<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\TransactioDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index');
    }

   

    public function create()
    {
        $customers = Customer::all();
        $employees = Employee::all();
        $menus = Menu::all();
        $stocks = Stock::all();

        return view('transactions.create', compact('customers', 'employees', 'menus', 'stocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'employee_id' => 'required|exists:employees,id',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'total_amount' => 'required|numeric',
            'transaction_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'customer_id' => $request->input('customer_id'),
                'employee_id' => $request->input('employee_id'),
                'description' => $request->input('description'),
                'total_amount' => $request->input('total_amount'),
                'transaction_date' => $request->input('transaction_date'),
            ]);

            $totalAmount = 0;

            foreach ($request->input('items') as $item) {
                $menu = Menu::find($item['menu_id']);
            
                $detail = TransactioDetail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $menu->price,
                    'subtotal' => $item['quantity'] * $menu->price,
                ]);
            
                $totalAmount += $detail->subtotal;
            }

            if ($request->filled('total_amount')) {
                $totalAmount = $request->input('total_amount');
            } else {
                $transaction->update(['total_amount' => $totalAmount]);
            }

            DB::commit();

            return redirect()->route('transactions.show', ['id' => $transaction->id])->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal membuat transaksi. Silakan coba lagi.']);
        }
    }

    public function showTransaction($id)
    {
        $transaction = Transaction::with('details.menu')->find($id);

        if (!$transaction) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        return view('transactions.show', compact('transaction'));
    }
}
