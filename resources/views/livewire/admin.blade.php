<div>
    <div class="w-[100wh-60px] lg:w-[100wh-250px] ml-[60px] lg:ml-[240px] p-5 right-0 transition-all duration-500 ease-in-out overflow-y-auto">
    <section id="content"
    class="w-[100wh-60px] lg:w-[100wh-250px] ml-[60px] lg:ml-[240px] p-5 right-0 transition-all duration-500 ease-in-out">
    <!-- user summary -->
    <div class="">
        <form wire:submit.prevent="updatedFilterDateAttribute" class="flex items-center">
            <label for="filterDate" class="mr-2">Filter by Date:</label>
            <div class="relative">
                <input type="date" id="filterDate" wire:model="filterDate" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                </div>
            </div>
            <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Filter</button>
        </form>
        
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-gray-300 p-5 m-2 rounded-md flex justify-between items-center shadow">
            <div>
                <h3 class="font-bold">Transaction</h3>
                <p class="text-gray-500">{{$transactionCount}}</p>
            </div>
            <svg class="h-8 w-8 text-gray-600"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="9" cy="21" r="1" />  <circle cx="20" cy="21" r="1" />  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" /></svg>

        </div>

        <div class="bg-blue-200 p-5 m-2 rounded-md flex justify-between items-center shadow">
            <div>
                <h3 class="font-bold">Jumlah Pendapatan</h3>
                <p class="text-gray-500">${{$totalRevenue}}</p>
            </div>
            <svg class="h-8 w-8 text-gray-600"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />  <path d="M12 6v2m0 8v2" /></svg>
        </div>

        <div class="bg-green-200 p-5 m-2 rounded-md flex justify-between items-center shadow">
            <div>
                <h3 class="font-bold">Jumlah Customer</h3>
                <p class="text-gray-500">{{$customer}}</p>
            </div>
            <svg class="h-8 w-8 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              
        </div>

        <div class="bg-slate-50 p-5 m-2 rounded-md flex justify-between items-center shadow">
            <div>
                <h3 class="font-bold">Jumlah Menu</h3>
                <p class="text-gray-500">{{$menu}}</p>
            </div>
            <svg class="h-8 w-8 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
              
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
        <!-- chart  -->
        <div id="revenue-chart" style="width: 100%; height: 500px;" wire:ignore>
            <canvas></canvas>
        </div>
<div class="container mx-auto my-8">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Pendapatan Harian dan Persentase</h2>
      {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        SEE ALL
      </button> --}}
    </div>
  
    <div class="overflow-x-auto">
      <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">DATE</th>
                <th class="py-3 px-6 text-left">REVENUE</th>
                <th class="py-3 px-6 text-left">PERCENTAGE</th>
            </tr>
        </thead>
        @foreach ($revenueData as $data)
        <tbody class="text-gray-600 text-sm font-light">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{$data ['date']}}</td>
                <td class="py-3 px-6 text-left">$ {{$data['revenue']}}</td>
                <td class="py-3 px-6 text-left">{{$data['percentage']}}%</td>
            </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
  
        <div class="container mx-auto my-8">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold">Customer</h2>
              {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                SEE ALL
              </button> --}}
            </div>
          
            <div class="overflow-x-auto">
              <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">USER NAME</th>
                        <th class="py-3 px-6 text-left">EMAIL</th>
                        <th class="py-3 px-6 text-left">PHONE</th>
                        <th class="py-3 px-6 text-left">STATUS</th>
                        <th class="py-3 px-6 text-left">ACTION</th>
                    </tr>
                </thead>
                @foreach($customers as $customer)
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{$customer->nama}}</td>
                        <td class="py-3 px-6 text-left">{{$customer->email}}</td>
                        <td class="py-3 px-6 text-left">{{$customer->no_telp}}</td>
                        <td class="py-3 px-6 text-left">
                            <span class="bg-green-50 text-green-700 px-3 py-2 ring-1 ring-green-200 text-xs rounded-md">Active</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex justify-between gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 cursor-pointer rounded-lg" viewBox="0 0 20 20" fill="currentColor" title="Edit">
                                    <path fill-rule="evenodd" d="M3.08 17.554a1 1 0 0 1-1.497-1.323l1.497-2.805a1 1 0 0 1 1.747.975l-1.747 2.805a.993.993 0 0 1 0 .348zM3 2.93c.006-.437.183-.86.504-1.181a1.665 1.665 0 0 1 2.343 0l9.717 9.717c.649.649.885 1.622.649 2.49l-1.354 5.742a1.5 1.5 0 0 1-1.732 1.105l-5.742-1.354a1.936 1.936 0 0 1-1.499-.65L2.929 7.271a1.668 1.668 0 0 1-.504-1.181V2.929zm13.957 7.757a.5.5 0 0 1-.122.612l-2.121 2.122a.5.5 0 0 1-.61.124l-8.486-3.535 2.121-2.122 8.486 3.536z"/>
                                </svg>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-500 cursor-pointer rounded-lg" viewBox="0 0 20 20" fill="currentColor" title="View">
                                    <path fill-rule="evenodd" d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 1a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm1 5a1 1 0 1 0-2 0v4a1 1 0 0 0 2 0V8zm-1 7a1 1 0 0 0-1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 0-1-1z"/>
                                </svg>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 cursor-pointer rounded-lg" viewBox="0 0 20 20" fill="currentColor" title="Delete">
                                    <path fill-rule="evenodd" d="M10 2a8 8 0 0 0-8 8c0 4.418 3.582 8 8 8s8-3.582 8-8a8 8 0 0 0-8-8zM6.879 12.121a1 1 0 1 1-1.414-1.414L8.586 10 5.465 6.879a1 1 0 0 1 1.414-1.414L10 8.586l3.121-3.121a1 1 0 0 1 1.414 1.414L11.414 10l3.121 3.121a1 1 0 0 1-1.414 1.414L10 11.414l-3.121 3.121z"/>
                                </svg>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
    </div>

    <div class="container mx-auto my-8">
        <div class="flex flex-wrap">
            <!-- Top 5 Penjualan -->
            <div class="m-2 flex-1 shadow-md overflow-y-auto">
                <header class="bg-gray-200 p-4 flex justify-between items-center">
                    <h2 class="text-gray-600 text-xl">Top 5 Penjualan</h2>
                        <a href="" class="text-gray-600 float-right">Lihat Detail</a>
                </header>
                <div class="p-4">
                    @if(count($mostOrderedMenus) > 0)
                    <table class="w-full">
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($mostOrderedMenus as $menu)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6"><img src="{{ Storage::url($menu['menu']->image) }}" alt="Menu Image" class="w-16 h-16 object-cover rounded-lg"></td>
                                <td class="py-3 px-6">{{ $menu['menu']->name }}</td>
                                <td class="py-3 px-6">{{ $menu['quantity'] }} pcs</td>
                                <td class="py-3 px-6 font-bold">${{ $menu['menu']->price }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="py-3 px-6" colspan="4">Belum ada data menu yang dipesan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @else
                    <p>Belum ada data menu yang dipesan.</p>
                    @endif
                </div>
            </div>
            
            
    
            <!-- Sisa Stok Tertinggi -->
            <div class="m-2 flex-1 shadow-md overflow-y-auto">
                <header class="bg-gray-200 p-4 flex justify-between items-center">
                    <h2 class="text-gray-600 text-xl">Sisa Stok Tertinggi</h2>
                    <a href="" class="text-gray-600">Lihat Detail</a>
                </header>
                
                <div class="p-4">
                    @if($highStockItems->isNotEmpty())
                        <table class="w-full">
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($highStockItems as $stock)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6"><img src="{{ Storage::url($stock->menu->image) }}" alt="Menu Image" class="w-16 h-16 object-cover rounded-lg"></td>
                                        <td class="py-3 px-6">{{ $stock->menu->name }}</td>
                                        <td class="py-3 px-6">{{ $stock->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4">Tidak ada menu dengan stok rendah.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
        
    
    
    
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   var revenueData = @json($revenueData);

var ctx = document.getElementById('revenue-chart').querySelector('canvas').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: revenueData.map(data => data.date),
        datasets: [{
            label: 'Pendapatan',
            data: revenueData.map(data => data.revenue),
            backgroundColor: 'rgba(128, 128, 128, 0.2)',
            borderColor: 'rgba(128, 128, 128, 1)',
            borderWidth: 1

        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

</div>
