<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-4 m-2 p-2">
                <a href="{{ route('admin.absen.export') }}" onclick="event.preventDefault(); document.getElementById('export-form').submit();" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                    Export Excel
                </a>
                <form id="export-form" action="{{ route('admin.absen.export') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('admin.employees.export') }}" onclick="event.preventDefault(); document.getElementById('export-form').submit();" class="px-4 py-2 bg-blue-600 hover:to-blue-500 rounded-lg text-white">
                    Export Pdf
                </a>
                <form id="export-form" action="{{ route('admin.employees.export') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{route('admin.absen.import')}}" id="import-form" onclick="evenht.preventDefault(); document.getElementById('file-input').click();" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                    Import
                </a>
                <form id="import-form" action="{{ route('admin.absen.import') }}" method="post" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="file" id="file-input" onchange="document.getElementById('import-form').submit();">
                </form>
            </div>
            
            <div class="flex justify-end m-1 p-2">
                <button id="newAbsenBtn" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    New Absen
                </button>

                <table id="absen-table" class="min-w-full">
                    <thead class="bg-gray-100 dark:bg-gray-700  data-twe-fixed-header">
                        <tr>
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
                        @foreach ($absens as $a)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                    {{ $a->status }}
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
                                        <a href="{{ route('admin.absen.edit', $a->id) }}"
                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                            id="myForm"
                                            method="POST"
                                            action="{{ route('admin.absen.destroy', $a->id) }}"
                                            onsubmit="return myScript(event);">
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

                {{-- <a href="{{ route('admin.absen.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Absen</a> --}}
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                                         <!-- Modal -->
             <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <!-- Modal content -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-title">
                        <!-- Your form content here -->
                        <form method="POST" action="{{ route('admin.absen.store')}}">
                            @csrf
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <!-- Input fields -->
                                <div class="mb-4">
                                    <label for="namaKaryawan" class="block text-gray-700 text-sm font-bold mb-2">Nama
                                        Karyawan:</label>
                                    <input type="text" name="namaKaryawan" id="namaKaryawan"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Nama Karyawan">
                                </div>
                                <div class="mb-4">
                                    <label for="tanggalMasuk"
                                        class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk:</label>
                                    <input type="date" name="tanggalMasuk" id="tanggalMasuk"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="status"
                                        class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                    <select name="status" id="status"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="waktuMasuk" class="block text-gray-700 text-sm font-bold mb-2">Waktu
                                        Masuk:</label>
                                    <input type="time" name="waktuMasuk" id="waktuMasuk"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div class="mb-4">
                                    <label for="waktuKeluar" class="block text-gray-700 text-sm font-bold mb-2">Waktu
                                        Keluar:</label>
                                    <input type="time" name="waktuKeluar" id="waktuKeluar"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Simpan
                                </button>
                                <button type="button"
                                    onclick="document.getElementById('modal').classList.add('hidden')"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Pagination Section -->
          <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
            @if ($absens->total() > 0)
                <div class="flex-1 flex justify-between sm:hidden">
                    <!-- Tombol-tombol navigasi pagination untuk tampilan layar kecil -->
                    {{ $absens->links('pagination::tailwind') }}
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <!-- Informasi halaman saat ini dan navigasi pagination -->
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-5">
                            Showing
                            <span class="font-medium">{{ $absens->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $absens->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $absens->total() }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <!-- Tombol navigasi pagination untuk tampilan besar -->
                        {{ $absens->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>

<script>
    window.myScript = function(event) {
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

<script>
    // Ketika dokumen selesai dimuat
    $(document).ready(function() {
        // Ketika tombol "New Absen" diklik
        $('#newAbsenBtn').click(function() {
            // Tampilkan modal
            $('#modal').removeClass('hidden');
        });

        // Ketika tombol "Batal" di dalam modal diklik
        $('#modal').on('click', '#cancelBtn', function() {
            // Sembunyikan modal
            $('#modal').addClass('hidden');
        });

        // Ketika tombol "Simpan" di dalam modal diklik
        $('#modal').on('click', '#saveBtn', function() {
            // Ambil nilai-nilai dari input di dalam modal
            const namaKaryawan = $btn.create('#namaKaryawan').val();
            const tanggalMasuk = $('#tanggalMasuk').val();
            const status = $('#status').val();
            const waktuMasuk = $('#waktuMasuk').val();
            const waktuKeluar = $('#waktuKeluar').val();

            // Lakukan sesuatu dengan nilai-nilai tersebut, misalnya menambahkan data ke dalam suatu struktur data di JavaScript
            // Misalnya, kita akan tambahkan data ke dalam sebuah array
            const newData = {
                namaKaryawan: namaKaryawan,
                tanggalMasuk: tanggalMasuk,
                status: status,
                waktuMasuk: waktuMasuk,
                waktuKeluar: waktuKeluar
            };
            // Tambahan: Simpan data baru ke dalam array atau struktur data lainnya sesuai kebutuhan Anda
            console.log('Data baru:', newData);

            // Sembunyikan modal setelah menambahkan data
            $('#modal').addClass('hidden');

            // Mencegah formulir dari mengirimkan permintaan bawaan
            return false;
        });
    });
</script>

