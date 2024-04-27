<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        .container {
    height: 500px; /* Atur ketinggian kontainer */
}

.overflow-y-auto {
    overflow-y: auto; /* Atur overflow-y menjadi auto */
}
    </style>

    <div class="overflow-y-auto">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

              <!-- Include your HTML structure here -->
              <main class="pt-6 px-4">
                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex-shrink-0">
                              <!-- HTML -->
<span id="total-amount" class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">$0</span>

                                <h3 class="text-base font-normal text-gray-500">Sales this week</h3>
                            </div>
                            <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                12.5%
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div id="main-chart"></div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Transactions</h3>
                                <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                            </div>
                        </div>
                        <div class="flex flex-col mt-8">
                            <div class="overflow-x-auto rounded-lg">
                                <div class="align-middle inline-block min-w-full">
                                    <div class="shadow overflow-hidden sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Transaction
                                                    </th>
                                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date & Time
                                                    </th>
                                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Amount
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white" id="latest-transactions">
                                                @foreach ($transaction as $t)
                                                    <tr class="text-center">
                                                        <td class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t->id }}</td>
                                                        <td class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t->transaction_date }}</td>
                                                        <td class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t->total_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900" id="new-products-count">2,340</span>
                                <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold" id="new-products-percentage">
                                14.6%
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900" id="visitors-count">5,355</span>
                                <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold" id="visitors-percentage">
                                32.9%
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900" id="user-signups-count">385</span>
                                <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
                            </div>
                            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold" id="user-signups-percentage">
                                -2.7%
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
                    <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                            <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                                View all
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200" id="latest-customers">
                                @foreach ($customer as $c)
                                {{-- <li class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$c->nama}}</li> --}}
                                <li class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$c->email}}</li>
                                {{-- <li class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$c->no_telp}}</li>    --}}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                        <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                                        <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                                        <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="acquisition-overview">
                                    <!-- Acquisition overview data will be displayed here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            

<!-- Include your HTML structure here -->

                <a 
                href="admin/transaction"
                class="flex"
                ><svg class="h-6 w-6 text-red-500 mr-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                  </svg>
                  GO TO TRANSACTION</a>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>

<script>
  var totalAmount = 0;
document.querySelectorAll('#latest-transactions .text-gray-500').forEach(function(element) {
    var amountText = element.textContent;

    var amount = parseFloat(amountText.replace('$', '').replace(',', ''));

    if (!isNaN(amount)) {
        totalAmount += amount;
    }
});

document.getElementById('total-amount').textContent = '$' + totalAmount.toFixed(2);

</script>