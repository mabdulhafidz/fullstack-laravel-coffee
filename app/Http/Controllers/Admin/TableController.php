<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TableExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Imports\TableImport;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('view-any', Table::class);

        $tables = Table::all();
        $tables = Table::paginate(5);
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $table = Table::all();
        return view('admin.tables.create', compact('table'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableStoreRequest $request)
    {
        Table::create([
            'name' => $request->name,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'location' => $request->location
        ]);

        return to_route('admin.tables.index')->with('success', 'Table created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        // $this->authorize('update', $table);

        return view('admin.tables.edit', compact('table'));
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TableStoreRequest $request, Table $table)
    {
        // $this->authorize('update', $table);

        $table->update($request->validated());

        return to_route('admin.tables.index')->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        // $this->authorize('delete', $table);

        $table->resersvation()->delete();
        $table->delete();

        return to_route('admin.tables.index')->with('danger', 'Table daleted successfully.');
    }

    public function export() 
    {
        return Excel::download(new TableExport, 'tables.xlsx');
    }

    public function pdf()
    {
     $data ['tables'] = Table::get();
        $pdf = Pdf::loadView('admin.tables.exportpdf', $data);
        return $pdf->stream('');
    }

 
    public function import(Request $request)
    {
        Excel::import(new TableImport, $request->file('file'));
        return redirect()->back()->with('success', 'Table imported successfully.');
    }
}
