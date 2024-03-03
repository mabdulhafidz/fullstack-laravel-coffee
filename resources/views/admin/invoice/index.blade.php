<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
  <div>
    <section class="py-20 bg-gray-500">
      <div class="max-w-5xl mx-auto py-16 bg-white">
        <article class="overflow-hidden">
          <div class="bg-[white] rounded-b-md">
            <div class="p-9">
              <div class="space-y-6 text-slate-700">
                <p class="text-xl font-extrabold tracking-tight uppercase font-body">Fidz Coffee</p>
              </div>
            </div>

            <div class="p-9">
              <div class="flex w-full">
                <div class="grid grid-cols-4 gap-12">
                  <!-- Invoice Detail -->
                  <div class="text-sm font-light text-slate-500">
                    <p class="text-sm font-normal text-slate-700">Invoice Detail:</p>
                    <p>Unwrapped</p>
                    <p>Fake Street 123</p>
                    <p>San Javier</p>
                    <p>CA 1234</p>
                  </div>
            
                  <!-- Billed To -->
                  {{-- customer --}}
                  <div class="text-sm font-light text-slate-500">
                    <p class="text-sm font-normal text-slate-700">Billed To</p>
                    <p>The Boring Company</p>
                    <p>Tesla Street 007</p>
                    <p>Frisco</p>
                    <p>CA 0000</p>
                  </div>
            
                  @if ($transaction)
                    <div class="text-sm font-light text-slate-500 ml-auto"> 
                      <p class="text-sm font-normal text-slate-700">Invoice Number</p>
                      <p>{{ $transaction->id }}</p>
            
                      <p class="mt-2 text-sm font-normal text-slate-700">Date of Issue</p>
                      <p>{{ $transaction->transaction_date }}</p>
                    </div>
                  @else
                    <p class="text-sm font-light text-slate-500 ml-auto">No transactions found.</p>
                  @endif
                </div>
              </div>
            </div>
            
            <div class="p-9">
              @if ($transaction)
              @if ($transaction->transactionDetails && count($transaction->transactionDetails) > 0)
              <div class="flex flex-col mx-0 mt-8">
                <table class="min-w-full divide-y divide-slate-500">
                    <thead>
                        <tr class="mr-4">
                            <th>Menu Name</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->transactionDetails as $detail)
                        <tr>
                            <td>{{ $detail->menu->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->quantity * $detail->unit_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Data invoice tidak memiliki detail transaksi.</p>
            @endif
            @else
            <p>Data invoice tidak ditemukan.</p>
            @endif
            </div>
            
            @php
            $totalAmount = $transaction->transactionDetails->sum('subtotal');
            $item = $transaction->transactionDetails->count('unit_price');
            @endphp
            <p class="text-xl font-bold mt-4">Total Amount: {{ $totalAmount }}</p>
            <p class="text-xl font-bold mt-4">Total Item: {{ $item }}</p>
          </div>
          <div class="mt-4 p-4 flex justify-center">
            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                Print
            </button>
        </div>
        </article>
      </div>
    </section>
  </div>
  
</body>

</html>
