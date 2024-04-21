<x-admin-layout>
    <div class="container">
        <h1 class="text-lg">Transaction List</h1>
    </div>
    <div class="flex space-x-6">
        <div class="mr-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-1">
                <div class="flex space-x-4 m-2 p-2" id="searchResults">
                    <a href="{{ route('admin.transactionlist.export') }}"
                        onclick="event.preventDefault(); document.getElementById('export-form').submit();"
                        class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                        Export Excel
                    </a>
                    <form id="export-form" action="{{ route('admin.transactionlist.export') }}" method="POST" style="display: none;">
                        @csrf
                    </form>



        <form action="{{ route('admin.transactionlist.index') }}" method="GET">
            <div class="flex items-center">
                <label for="transaction_date" class="mr-2">Transaction Date:</label>
                <input type="date" id="transaction_date" name="transaction_date" class="mr-2">
                <button type="submit" class="bg-gray-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                @if (request()->has('transaction_date'))
                    <a href="{{ route('admin.transactionlist.index') }}" class="text-sm ml-2">Clear Search</a>
                @endif
            </div>
        </form>
        

    </div>
    
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Transaction_Id
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Quantity
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Unit Price
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Amount
                                </th>
                                <th scope="col"
                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Date Of Issue
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Transactiondetail as $d)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->transaction_id }}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->quantity }}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->unit_price }}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->subtotal }}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $d->transaction->transaction_date }}
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>