<?php

namespace App\Livewire;

use App\Models\ProdukTitipan as ModelsProdukTitipan;
use Livewire\Component;

class ProdukTitipan extends Component
{
    public $nama_produk;
    public $nama_supplier;
    public $harga_beli;
    public $harga_jual;
    public $stock;
    public $keterangan;
    public $produktitipan_id;

    protected $rules = [
        'nama_produk' => 'required',
        'nama_supplier' => 'required',
        'harga_beli' => 'required|numeric',
        'harga_jual' => 'numeric',
        'stock' => 'required|numeric',
        'keterangan' => 'nullable',
    ];

    public function updatedHargaBeli()
    {
        $this->harga_jual = $this->calculateHargaJual();
    }

    private function calculateHargaJual()
    {
        $hargaBeli = $this->harga_beli;
        $keuntungan = $hargaBeli * 0.7;
        $hargaJual = ceil(($hargaBeli + $keuntungan) / 500) * 500;
        // dd($hargaJual); 
        return $hargaJual;
    }

    public function render()
    {
        return view('livewire.produk-titipan', [
            'harga_jual' => $this->harga_jual,
        ]);
    }

    public function store()
    {
        $this->validate();

        ModelsProdukTitipan::create([
            'nama_produk' => $this->nama_produk,
            'nama_supplier' => $this->nama_supplier,
            'harga_beli' => $this->harga_beli,
            // 'harga_jual' => $this->calculateHargaJual(), 
            'harga_jual' => $this->harga_jual, 
            'stock' => $this->stock,
            'keterangan' => $this->keterangan,
        ]);
    
        $this->reset();
    }
}
