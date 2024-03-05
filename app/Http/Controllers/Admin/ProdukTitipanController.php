<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProdukTitipanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukTitipanStoreRequest;
use App\Imports\ProdukTitipanImport;
use App\Models\ProdukTitipan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produktitipan = ProdukTitipan::all();
        return view('admin.produktitipan.index', compact('produktitipan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produktitipan = ProdukTitipan::all();
        return view('admin.produktitipan.create', compact('produktitipan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukTitipanStoreRequest $request)
    {
        $produktitipan = ProdukTitipan::create([
            'nama_produk' => $request->nama_produk,
            'nama_supplier' => $request->nama_supplier,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stock' => $request->stock,
            'keterangan' => $request->keterangan,
        ]);

        return to_route('admin.produktitipan.index')->with('success', 'Produk Titipan created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produktitipan = ProdukTitipan::findOrFail($id);
        return view('admin.produktitipan.edit', compact('produktitipan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukTitipan $produktitipan)
    {
        $request->validate([
            'nama_produk' => 'required',
            'nama_supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'keterangan' => 'required',
        ]);

        $produktitipan->update([
            'nama_produk' => $request->nama_produk,
            'nama_supplier' => $request->nama_supplier,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stock' => $request->stock,
            'keterangan' => $request->keterangan,
        ]);

        return to_route('admin.produktitipan.index')->with('success', 'ProdukTitipan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukTitipan $produktitipan)
    {
        $produktitipan->delete();
        return to_route('admin.produktitipan.index')->with('danger', 'ProdukTitipan deleted successfully.');
    }

    public function export() 
    {
        return Excel::download(new ProdukTitipanExport, 'produktitipan.xlsx');
    }
   
    public function pdf(Request $request)
    {
        $data = ProdukTitipan::all(); 
        $pdf = PDF::loadView('pdf.pdf', compact('data'));

        return $pdf->download('produktitipan.pdf');
    }


    public function import($request)
    {
    Excel::import(new ProdukTitipanImport(), $request->file('file'));

    return redirect()->back()->with('success', 'Produk Titipan imported successfully.');
    }
}
