<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MenuExport;
use App\Exports\TypeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\StoreTypeRequest;
use App\Imports\MenuImport;
use App\Imports\TypeImport;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $types = Type::paginate(5);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $categories = Category::all();
        return view('admin.types.create', compact('types', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        $type = Type::create([
            'name' => $request->name,
        ]);

        if ($request->has('categories')) {
            $type->categories()->attach($request->categories);
        }

        return to_route('admin.types.index')->with('success', 'Type created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $categories = Category::all();
        return view('admin.types.edit', compact('type', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $type->update([
            'name' => $request->name,
        ]);

        return to_route('admin.types.index')->with('success', 'Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        // $type->types()->detach();
        $type->delete();
        return to_route('admin.types.index')->with('danger', 'Type deleted successfully.');
    }

    public function export() 
    {
        return Excel::download(new TypeExport, 'types.xlsx');
    }

    public function pdf()
    {
     $data ['types'] = Type::get();
        $pdf = Pdf::loadView('admin.types.exportpdf', $data);
        return $pdf->stream('');
    }

    public function import(Request $request)
    {
        Excel::import(new TypeImport, $request->file('file'));
        return redirect()->back()->with('success', 'Type imported successfully.');
    }
}
