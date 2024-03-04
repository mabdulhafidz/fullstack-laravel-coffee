<x-admin-layout>
    <div class="container">
        <h1 class="text-lg">Transaction List</h1>
    </div>
    <div class="flex space-x-6">
        <div class="mr-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-1">
                <select id="large" class="block w-1/4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Show All</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            @error('status')
                <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="ml-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-1">
                <select id="large" class="block w-1/4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Show All</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            @error('status')
                <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
        <div class="ml-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Payment Method</label>
            <div class="mt-1">
                <select id="large" class="block w-1/4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Show All</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            @error('status')
                <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
        <div class="ml-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-1">
                <select id="large" class="block w-1/4 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Show All</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            @error('status')
                <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
        <div class="ml-3">
            <label for="large" class="block text-sm font-medium text-gray-700">Time</label>
            <div class="mt-1">
                <select id="large" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Show All</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            @error('status')
                <div class="text-sm text-red-400">{{ $message }}</div>
            @enderror
        </div>
        
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
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $d->transaction_id }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $d->quantity }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $d->unit_price }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $d->subtotal }}
                                    </td>
                                    {{-- @if ($transaction)
                                        
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $transaction->transaction_date }}
                                    </td>
                                    @else
                                        
                                    @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>