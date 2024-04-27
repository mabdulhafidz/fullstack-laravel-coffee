<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AbsensiExport;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Imports\AbsensiImport;
use Barryvdh\DomPDF\facade\PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use PDF;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('view-any', Absensi::class);
        $absensis = Absensi::all();
        $absensis = Absensi::paginate(5);

        return view('admin.absensi.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($absensi)
    {
        // $this->authorize('create', $absensi);
        return view('admin.absensi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsensiRequest $request, $absensi)
    {
        // $this->authorize('create', $absensi);

        $validatedData = $request->validated();
    
        $namaKaryawan = $validatedData['namaKaryawan'];
        $tanggalMasuk = Carbon::parse($validatedData['tanggalMasuk']);
        $waktuMasuk = Carbon::parse($validatedData['waktuMasuk']);
        $status = $validatedData['status'];
    
        // Check if the waktuMasuk is within the current date
        if ($waktuMasuk->format('Y-m-d') !== $tanggalMasuk->format('Y-m-d')) {
            return redirect()->back()->withErrors(['waktuMasuk' => 'Waktu masuk harus sesuai dengan tanggal masuk.']);
        }
    
        // Calculate waktuKeluar based on waktuMasuk and assuming a 7-hour shift
        $waktuKeluar = $waktuMasuk->copy()->addHours(7);
    
        $absensi = Absensi::create([
            'namaKaryawan' => $namaKaryawan,
            'tanggalMasuk' => $tanggalMasuk,
            'waktuMasuk' => $waktuMasuk,
            'status' => $status,
            'waktuKeluar' => $waktuKeluar,
        ]);
    
        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }


    public function updateStatus(Request $request)
        {
            $id = $request->input('id');
            $status = $request->input('status');

            // Temukan data absensi berdasarkan id
            $absensi = Absensi::findOrFail($id);

            // Perbarui status
            $absensi->status = $status;
            $absensi->save();

            // Kirim respons kembali ke klien
            return response()->json(['message' => 'Status berhasil diperbarui']);
        }


    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }
    public function edit(Absensi $absensi)
    {
        // $this->authorize('update', $absensi);

        return view('admin.absensi.edit', compact('absensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        // $this->authorize('update', $absensi);

        $validatedData = $request->validated();

        $absensi->update([
            'namaKaryawan' => $validatedData['namaKaryawan'],
            'tanggalMasuk' => Carbon::parse($validatedData['tanggalMasuk']),
            'waktuMasuk' => Carbon::parse($validatedData['waktuMasuk']),
            'status' => $validatedData['status'],
            'waktuKeluar' => Carbon::parse($validatedData['waktuMasuk'])->addHours(7),
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        // $this->authorize('delete', $absensi);

        $absensi->delete();

        return redirect()->route('admin.absensi.index')->with('success', 'Absensi berhasil dihapus.');
    }

    public function export()
    {
        try {
            return Excel::download(new AbsensiExport, 'absensis.xlsx');
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function pdf()
    {
     $data ['absensi'] = Absensi::get();
        $pdf = PDF::loadView('admin.absensi.exportpdf', $data);
        return $pdf->stream('');
    }

    public function import(Request $request)
    {
        Excel::import(new AbsensiImport, $request->file('file'));
        return redirect()->back()->with('success', 'Absensi imported successfully.');
    }

    
}
