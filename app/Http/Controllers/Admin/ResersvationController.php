<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResersvationStoreRequest;
use App\Models\Resersvation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResersvationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resersvation = Resersvation::all();
        return view('admin.resersvation.index', compact('resersvation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Avalaiable)->get();
        return view('admin.resersvation.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResersvationStoreRequest $request)
    {
        $table = Table::findOrFail($request->table_id);
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $request_date = Carbon::parse($request->res_date);
        foreach ($table->resersvation as $res) {  
            if ($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }
        Resersvation::create($request->validated());

        return to_route('admin.resersvation.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resersvation $resersvation)
    {
        $tables = Table::where('status', TableStatus::Avalaiable)->get();
        return view('admin.resersvation.edit', compact('resersvation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResersvationStoreRequest $request, Resersvation $resersvation)
    {
        $table = Table::findOrFail($request->table_id);
    
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table based on guests.');
        }
    
        $request_date = Carbon::parse($request->res_date);
    
        // Use findOrFail to get a specific reservation
        $existingReservation = $table->resersvation()->where('id', '!=', $resersvation->id)->first();
    
        if ($existingReservation && $existingReservation->res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
            return back()->with('warning', 'This table is reserved for this date.');
        }
    
        // Call update on the single model instance
        $resersvation->update($request->validated());
    
        return redirect()->route('admin.resersvation.index')->with('success', 'Reservation updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resersvation $resersvation)
    {
        $resersvation->delete();

        return to_route('admin.resersvation.index')->with('warning', 'Reservation deleted successfully.');
    }
}
