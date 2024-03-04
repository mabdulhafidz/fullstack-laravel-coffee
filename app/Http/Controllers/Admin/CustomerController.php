<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::all();
        return view('admin.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        customer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return to_route('admin.customer.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_telp' => 'required'
        ]);
        $customer->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        return to_route('admin.customer.index')->with('success', 'customer updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return to_route('admin.customer.index')->with('danger', 'customer is deleted.');
    }

    public function export() 
    {
        try {
            return Excel::download(new CustomerExport, 'categories.xlsx');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function exportPdf() 
    {
        try {
            $data = [
                'customers' => Customer::all(),
            ];
    
            $pdf = FacadePdf::loadView('customers.pdf', $data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function import()
    // {
    //     Excel::download(new CustomerImport(), request()->file('file'));
    
    //     return redirect()->back()->with('success', 'Categories imported successfully.');
    // }
    
}

