<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Imports\CategoryImport;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $categories = Category::all();
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {   
        $image = $request->file('image')->store('public/categories');

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk tipe dan ukuran gambar
        ]);
    
        // Simpan path file yang lama
        $oldImagePath = $category->image;
    
        // Perbarui data kategori
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    
        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($oldImagePath !== null) {
                Storage::delete($oldImagePath);
            }
    
            // Simpan gambar yang baru diunggah
            $imagePath = $request->file('image')->store('public/categories');
            $category->update(['image' => $imagePath]);
        }
    
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        Storage::delete($category->image);
        $category->menus()->detach();
        $category->delete();

        return to_route('admin.categories.index')->with('danger', 'Category is  deleted.');
    }

    public function export() 
    {
        try {
            return Excel::download(new CategoryExport, 'categories.xlsx');
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function pdf()
    {
     $data ['categories'] = Category::get();
        $pdf = PDF::loadView('admin.categories.exportpdf', $data);
        return $pdf->stream('');
    }
    
    public function import(Request $request)
    {
        Excel::import(new CategoryImport, $request->file('file'));
        return redirect()->back()->with('success', 'Categories imported successfully.');
    }

}

