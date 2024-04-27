<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AbsenExport;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;
use App\Imports\AbsenImport;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absens = Absen::all();
        $absens = Absen::paginate(5);

        return view('admin.absen.index', compact('absens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenRequest $request)
    {
        $validate = $request->validated();

        $namaKaryawan = $validate['namaKaryawan'];
        $tanggalMasuk = Carbon::parse($validate['tanggalMasuk']);
        $waktuMasuk = Carbon::parse($validate['waktuMasuk']);
        $status = $validate['status'];

        if($waktuMasuk->format('Y-m-d') !== $tanggalMasuk->format('Y-m-d')) {
            return redirect()->back()->withErrors(['waktuMasuk' => 'Waktu Masuk Harus sesuai dengan tanggal masuk']);
        } 

        $waktuKeluar = $waktuMasuk->copy()->addHours(7);

            Absen::create([
            'namaKaryawan' => $namaKaryawan,
            'tanggalMasauk' => $tanggalMasuk,
            'waktuMasuk' => $waktuMasuk,
            'status' => $status,
            'waktuKeluar' => $waktuKeluar 
        ]);
        return redirect()->route('admin.absen.index')->with('successs', 'Absensi Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absen $absen)
    {
        $absen->delete();

        return redirect()->route('admin.absen.index')->with('danger', 'Berhasil di Hapus');
    }

    public function export()
    {
        try {
            return Excel::download(new AbsenExport, 'absens.xlsx');
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function import(Request $request)
    {
        Excel::import(new AbsenImport, $request->file('file'));
        return redirect()->back()->with('success', 'Absen imported successfully.');
    }
}
