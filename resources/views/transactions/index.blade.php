<x-guest-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Daftar Transaksi
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                      <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              No
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Keterangan
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Total Harga
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Tanggal
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Aksi
                          </th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($transactions as $transaction)
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  {{ $loop->index + 1 }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  {{ $transaction->description }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  {{ $transaction->total_amount }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  {{ $transaction->transaction_date }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <a href="{{ route('transactions.show', $transaction->id) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      <div class="mt-4">
          <a href="{{ route('transactions.create') }}" class="text-green-500 hover:text-green-700">Tambah Transaksi</a>
      </div>
  </div>
</x-guest-layout>
