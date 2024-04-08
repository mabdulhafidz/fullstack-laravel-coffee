<?php

namespace App\Livewire\Admin;

use App\Exports\CategoryExport;
use App\Http\Requests\CategoryStoreRequest;
use App\Imports\CategoryImport;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Response;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $description, $image, $category;
    public $showEditModal = false;
    public $data = [];
    // public $categories;
    public $categoriess;

    protected $rules = [
        'name' => 'required',   
        'description' => 'required',
        'image' => 'nullable|image|max:1024',
    ];

    public function render()
    {
        return view('livewire.admin.categories', [
            'categories' => Category::paginate(5),
        ]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->showEditModal = false;
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->validate();

        $image = $this->image->store('public/categories');

        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $image,
        ]);

        $this->resetCreateForm();
        $this->dispatchBrowserEvent('category-created');
    }

    public function edit(Category $category)
    {
        $this->resetCreateForm();
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->image = null;
        $this->showEditModal = true;
    }

    public function update(Category $category)
    {
        $this->validate();

        $image = $category->image;
        if ($this->image) {
            Storage::delete($category->image);
            $image = $this->image->store('public/categories');
        }

        $category->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $image,
        ]);

        $this->resetCreateForm();
        $this->dispatchBrowserEvent('category-updated');
    }

    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->menus()->detach();
        $category->delete();

        $this->dispatchBrowserEvent('category-deleted');
    }

    public function generatePdf()
    {
        $data = Category::all()->toArray();     

        $pdf = PDF::loadView('category-pdf', $data);
            return response()->download(function() use ($pdf) {
            return $pdf->output();
        }, 'category-pdf.pdf');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new CategoryImport, $this->file);
        $this->dispatchBrowserEvent('categories-imported');
        $this->resetCreateForm();
    }

    private function resetCreateForm()
    {
        $this->name = '';
        $this->description = '';
        $this->image = null;
        $this->category = null;
        $this->showEditModal = false;
    }
}