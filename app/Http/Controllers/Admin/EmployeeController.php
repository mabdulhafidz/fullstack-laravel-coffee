<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\Golongan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $employees = Employee::paginate(5);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(EmployeeStoreRequest $request)
    {
        $image = $request->file('image')->store('public/employees');

          Employee::create([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telpon' => $request->telpon,
            'agama' => $request->agama,
            'status_nikah' => $request->status_nikah,
            'alamat' => $request->alamat,
            'image' => $image,
        ]);

        dd($request);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }
    

    public function update($request, Employee $employee)
    {
        $request->validate([
            'nip' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'telpon' => 'required',
            'agama' => 'required',
            'status_nikah' => 'required',
            'alamat' => 'required',
        ]);

        $image = $employee->image;
        if ($request->hasFile('image')) {
            Storage::delete($employee->image);
            $image = $request->file('image')->store('public/employees');
        }

        $employee->update([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telpon' => $request->telpon,
            'agama' => $request->agama,
            'status_nikah' => $request->status_nikah,
            'alamat' => $request->alamat,
            'image' => $image,
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        Storage::delete($employee->image);
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('danger', 'Employee deleted successfully.');
    }

    public function export() 
    {
        return Excel::download(new EmployeeExport, 'employees.xlsx');
    }
    
    public function pdf()
    {
     $data ['employee'] = Employee::get();
        $pdf = Pdf::loadView('admin.employees.exportpdf', $data);
        return $pdf->stream('');
    }

    
    public function import(Request $request)
    {
        Excel::import(new EmployeeImport, $request->file('file'));
        return redirect()->back()->with('success', 'Employee imported successfully.');
    }
}
