<div>
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('admin.produktitipan.index') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Produk Titipan Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" wire:submit.prevent="store" enctype="multipart/form-data">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="nama_produk" class="block text-sm font-mediPum text-gray-700"> Nama Produk </label>
                                <div class="mt-1">
                                    <input wire:model="nama_produk" type="text" id="nama_produk"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="nama_supplier" class="block text-sm font-medium text-gray-700"> Nama Supplier </label>
                                <div class="mt-1">
                                    <input wire:model="nama_supplier" type="text" id="nama_supplier"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('nama_supplier')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                                <div class="mt-1">
                                    <input wire:model="harga_beli" type="number" id="harga_beli"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('harga_beli')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="number" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                                <div class="mt-1">
                                    <input type="number" wire:model="harga_jual" placeholder="Harga Jual" readonly
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" >
                                @error('harga_jual')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>                                   
                            <div class="sm:col-span-6 pt-5">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <div class="mt-1">
                                    <input wire:model="stock" type="number" id="stock"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('stock')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <div class="mt-1">
                                    <textarea wire:model="keterangan" id="keterangan"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" ></textarea>
                                </div>
                                @error('keterangan')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-6 p-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Store</button>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
        </div>
    </x-admin-layout>
    
</div>
