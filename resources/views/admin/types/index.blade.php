<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recent Transactions') }}
        </h2>
        <p class="text-gray-700 dark:text-gray-300">
            These are details about the last transactions
        </p>
    </x-slot>

    <div class="py-12">
    <div class="mx-2 mt-2 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

        <!-- Search Bar -->
        <!-- Export and Import Buttons -->
        <div class="flex space-x-4 m-2 p-2" id="searchResults">
            <a href="{{ route('admin.types.export') }}"
                onclick="event.preventDefault(); document.getElementById('export-form').submit();"
                class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                Export Excel
            </a>
            <form id="export-form" action="{{ route('admin.types.export') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('admin.cek') }}"
                class="px-4 py-2 bg-blue-600 hover:to-blue-500 rounded-lg text-white">
                Export Pdf
            </a>
            <a href="{{ route('admin.types.import') }}"
                onclick="event.preventDefault(); document.getElementById('file-input').click();"
                class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                Import
            </a>
            <form id="import-form" action="{{ route('admin.types.import') }}" method="POST"
                enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="file" id="file-input"
                    onchange="document.getElementById('import-form').submit();">
            </form>
        </div>
        <div class="flex justify-end m-2 p-2">
            <a href="{{ route('admin.types.create') }}"
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Types</a>
            </div>
            <div class="flex w-full gap-2 shrink-0 md:w-max">
                <form class="flex items-center" wire:submit.prevent="search">
                    <input id="searchinput" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2" placeholder="Search..." required>
                </form>
            </div>
            
        <!-- Table -->
        <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table id="mytable" class="min-w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Name
                                </th>
                                <th scope="col"
                                class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Action
                            </th>
                                <th scope="col" class="relative px-4 py-2">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td
                                    class="border px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $type->name }}
                                </td>
                                <td
                                    class="border px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.types.edit', $type->id) }}"
                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                            id="myForm"
                                            method="POST"
                                            action="{{ route('admin.types.destroy', $type->id) }}"
                                            onsubmit="return myScript(event);">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" id="btn-submit">Delete</button>
                                      </form>                                      
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            </tr>

                        </tbody>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    </div>



        <!-- Pagination Section -->
        <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
            @if ($types->total() > 0)
                <div class="flex-1 flex justify-between sm:hidden">
                    <!-- Tombol-tombol navigasi pagination untuk tampilan layar kecil -->
                    {{ $types->links('pagination::tailwind') }}
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <!-- Informasi halaman saat ini dan navigasi pagination -->
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-5">
                            Showing
                            <span class="font-medium">{{ $types->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $types->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $types->total() }}</span>
                            results
                        </p>
                    </div>
                    <div class="flex items-center">
                    </div>
                    <div>
                        {{ $types->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>

<script>
jQuery.noConflict();
jQuery(document).ready(function($) {
    $('#mytable').DataTable();
});

</script>
<script>

    window.myScript = function(event) {
       event.preventDefault(); 
       Swal.fire({
       title: 'Are you sure?',
       text: "You won't be able to revert this!",
       icon: 'warning',
       showCancelButton: true,
       cancelButtonColor: '#d33',
       confirmButtonText: '#3085d6',
       confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
       if (result.isConfirmed) {
           event.target.submit();
       }
   });
   };  
   </script>