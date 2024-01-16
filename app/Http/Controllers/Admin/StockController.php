<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockStoreRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('admin.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockStoreRequest $request)
    {
        Stock::create([
            'jumlah' => $request->jumlah,
            'menu_id' => $request->menu_id,
        ]);

        return to_route('admin.stocks.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockStoreRequest $request, Stock $stock)
    {
        $stock->update($request->validated());

        return to_route('admin.stocks.index')->with('success', 'Stock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->reservations()->delete();
        $stock->delete();

        return to_route('admin.stocks.index')->with('danger', 'Stock daleted successfully.');
    }
}
