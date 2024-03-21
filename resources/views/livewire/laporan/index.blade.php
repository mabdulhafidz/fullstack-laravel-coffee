<div>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
            .header { background-color: #6a1b9a; color: white; padding: 20px; text-align: center; }
            .card { background-color: white; padding: 20px; margin: 10px; border-radius: 5px; display: inline-block; width: calc(20% - 20px); }
            .card h3 { margin: 0; }
            .card p { margin: 5px 0; }
            .filters { text-align: right; padding: 20px; }
            .table { width: 100%; margin-top: 20px; }
            .table th, .table td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
          </style>
          </head>
          <body>
            <div class="header">
              <h1>Total Revenue</h1>
              <p>$14,260 • +10%</p>
            </div>
            <div class="filters">
                <select wire:model="filter">
                    <option>December 2023</option>
                    <option>Last 7 Days</option>
                </select>
            </div>            
            <div>
              <div class="card">
                <h3>Revenue</h3>
                <p>$5,660 • +990</p>
              </div>
              <!-- Repeat for other cards -->
            </div>
            <div class="overflow-auto">
              <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                      <tr>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($transaction as $item)
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap">{{$item->id}}</td>
                              <td class="px-6 py-4 whitespace-nowrap">{{$item->transaction_date}}</td>
                              <td class="px-6 py-4 whitespace-nowrap">$ {{$item->total_amount}}</td>
                              <td class="px-6 py-4 whitespace-nowrap"></td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
</div>
