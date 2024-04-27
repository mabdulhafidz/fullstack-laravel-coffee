<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-4 m-2 p-2">
                <a href="{{ route('admin.absensi.export') }}" onclick="event.preventDefault(); document.getElementById('export-form').submit();" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                    Export Excel
                </a>
                <form id="export-form" action="{{ route('admin.absensi.export') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('admin.tes') }}" class="px-4 py-2 bg-blue-600 hover:to-blue-500 rounded-lg text-white">
                    Export Pdf
                </a>
                <a href="{{ route('admin.absensi.import') }}"
                onclick="event.preventDefault(); document.getElementById('file-input').click();"
                class="px-4 py-2 bg-green-500 hover:bg-green-700 rounde d-lg text-white">
                Import
            </a>
            <form id="import-form" action="{{ route('admin.absensi.import') }}" method="POST"
                enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="file" id="file-input"
                    onchange="document.getElementById('import-form').submit();">
            </form>
            </div>
            
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.absensi.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Absensi</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table id="absensi-table" class="min-w-full">
                                <thead class="bg-gray-100 dark:bg-gray-700  data-twe-fixed-header">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            No
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Nama Karyawan
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Tanggal Masuk
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Waktu Masuk
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                        <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Waktu Selesai Kerja
                                        </th>
                                        <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Action
                                        </th>
                                        <th scope="col" class="relative py-3 px-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $a)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $a->id }}
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $a->namaKaryawan }}
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $a->tanggalMasuk }}
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                @if ($a->status === 'Masuk')
                                                    {{ $a->waktuMasuk }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="relative">
                                                    <select
                                                        class="form-select appearance-none block w-auto px-2 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                        name="status_{{ $a->id }}"
                                                        onchange="updateStatus({{ $a->id }}, this.value)"
                                                    >
                                                        <option value="Masuk" {{ $a->status === 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                                        <option value="Sakit" {{ $a->status === 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                                        <option value="Cuti" {{ $a->status === 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                @if ($a->status === 'Masuk')
                                                    @if (now()->diffInHours(Carbon\Carbon::parse($a->waktuKeluar)) < 7)
                                                        {{ Carbon\Carbon::parse($a->waktuKeluar)->format('H:i') }}
                                                    @else
                                                        <span class="text-green-500">Selesai</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.absensi.edit', $a->id) }}"
                                                        class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                        id="myForm"
                                                        method="POST"
                                                        action="{{ route('admin.absensi.destroy', $a->id) }}"
                                                        onsubmit="return tes(event);">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit" id="btn-submit">Delete</button>
                                                  </form>   
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Pagination Section -->
          <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
            @if ($absensis->total() > 0)
                <div class="flex-1 flex justify-between sm:hidden">
                    <!-- Tombol-tombol navigasi pagination untuk tampilan layar kecil -->
                    {{ $absensis->links('pagination::tailwind') }}
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <!-- Informasi halaman saat ini dan navigasi pagination -->
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-5">
                            Showing
                            <span class="font-medium">{{ $absensis->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $absensis->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $absensis->total() }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <!-- Tombol navigasi pagination untuk tampilan besar -->
                        {{ $absensis->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>

<script>
    window.tes = function(event) {
       event.preventDefault(); 
       Swal.fire({
       title: 'Are you sure?',
       text: "You won't be able to revert this!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
       if (result.isConfirmed) {
           event.target.submit();
       }
   });
   };  

</script>
