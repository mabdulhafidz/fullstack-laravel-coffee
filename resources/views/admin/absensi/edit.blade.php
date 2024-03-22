<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.absensi.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Absensi Index</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.absensi.update', $absensi->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="namaKaryawan" class="block text-sm font-medium text-gray-700"> Nama Karyawan </label>
                            <div class="mt-1">
                                <input type="text" id="namaKaryawan" name="namaKaryawan" value="{{ $absensi->namaKaryawan }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('namaKaryawan')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="tanggalMasuk" class="block text-sm font-medium text-gray-700"> Tanggal Masuk </label>
                            <div class="mt-1">
                                <input type="date" id="tanggalMasuk" name="tanggalMasuk" value="{{$absensi->tanggalMasuk}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('tanggalMasuk') border-red-400 @enderror" />
                            </div>
                            @error('tanggalMasuk')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="waktuMasuk" class="block text-sm font-medium text-gray-700"> Waktu Masuk </label>
                            <div class="mt-1">
                                <input type="time" id="waktuMasuk" name="waktuMasuk" value="{{$absensi->waktuMasuk}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('waktuMasuk') border-red-400 @enderror" />
                            </div>
                            @error('waktuMasuk')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700"> Status </label>
                            <div class="mt-1">
                                <select id="status" name="status" value="{{$absensi->status}}"
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('status') border-red-400 @enderror">
                                <option selected disabled>Status</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                            </div>
                            @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="waktuKeluar" class="block text-sm font-medium text-gray-700"> Waktu Keluar </label>
                            <div class="mt-1">
                                <input type="time" id="waktuKeluar" name="waktuKeluar" value="{{$absensi->waktuKeluar}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('waktuKeluar') border-red-400 @enderror" />
                            </div>
                            @error('waktuKeluar')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
