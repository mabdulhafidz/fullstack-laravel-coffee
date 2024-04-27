<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Exports\ResersvationExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResersvationStoreRequest;
use App\Imports\ResersvationImport;
use App\Models\Resersvation;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResersvationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resersvation = Resersvation::all();
        $resersvation = Resersvation::paginate(5);
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

    public function export() 
    {
        return Excel::download(new ResersvationExport, 'resersvation.xlsx');
    }

    public function pdf()
    {
     $data ['resersvation'] = Resersvation::get();
        $pdf = Pdf::loadView('admin.resersvation.exportpdf', $data);
        return $pdf->stream('');
    }

    public function import(Request $request)
    {
        Excel::import(new ResersvationImport, $request->file('file'));
        return redirect()->back()->with('success', 'Reservation imported successfully.');
    }
}
