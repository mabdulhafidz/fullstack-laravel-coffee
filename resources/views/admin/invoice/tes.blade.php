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
    <section class="py-20 bg-black">
        <div class="max-w-5xl mx-auto py-16 bg-white">
         <article class="overflow-hidden">
          <div class="bg-[white] rounded-b-md">
           <div class="p-9">
            <div class="space-y-6 text-slate-700">
       
             <p class="text-xl font-extrabold tracking-tight uppercase font-body">
           Fidz Coffee
             </p>
            </div>
           </div>
           <div class="p-9">
            <div class="flex w-full">
             <div class="grid grid-cols-4 gap-12">
              <div class="text-sm font-light text-slate-500">
               <p class="text-sm font-normal text-slate-700">
                Invoice Detail:
               </p>
               <p>Unwrapped</p>
               <p>Fake Street 123</p>
               <p>San Javier</p>
               <p>CA 1234</p>
              </div>
              <div class="text-sm font-light text-slate-500">
               <p clafeat   ss="text-sm font-normal text-slate-700">Billed To</p>
               <p>The Boring Company</p>
               <p>Tesla Street 007</p>
               <p>Frisco</p>
               <p>CA 0000</p>
              </div>
              <div class="text-sm font-light text-slate-500">
               <p class="text-sm font-normal text-slate-700">Invoice Number</p>
               <p>000000</p>
       
               <p class="mt-2 text-sm font-normal text-slate-700">
                Date of Issue
               </p>
               <p>00.00.00</p>
              </div>
              <div class="text-sm font-light text-slate-500">
               <p class="text-sm font-normal text-slate-700">Terms</p>
               <p>0 Days</p>
       
               <p class="mt-2 text-sm font-normal text-slate-700">Due</p>
               <p>00.00.00</p>
              </div>
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
@endphp
<p class="text-xl font-bold mt-4">Total Amount: {{ $totalAmount }}</p>
        
            
               </tr>
              </thead>
              <tbody>
               <tr class="border-b border-slate-200">
                <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                 <div class="font-medium text-slate-700">Tesla Truck</div>
                 <div class="mt-0.5 text-slate-500 sm:hidden">
                  1 unit at $0.00
                 </div>
                </td>
                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                 48
                </td>
                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                 $0.00
                </td>
                <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
               <tr class="border-b border-slate-200">
                <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                 <div class="font-medium text-slate-700">
                  {{-- @foreach ($menus as $menus)
                      {{$menus->name}}
                  @endforeach --}}
                  tes
                 </div>
                 <div class="mt-0.5 text-slate-500 sm:hidden">
                  1 unit at $75.00
                 </div>
                </td>
                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                 4
                </td>
                <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                 $0.00
                </td>
                <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
       
               <!-- Here you can write more products/tasks that you want to charge for-->
              </tbody>
              <tfoot>
               <tr>
                <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                 Subtotal
                </th>
                <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                 Subtotal
                </th>
                <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
               <tr>
                <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                 Discount
                </th>
                <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                 Discount
                </th>
                <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
               <tr>
                <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                 Tax
                </th>
                <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                 Tax
                </th>
                <td class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
               <tr>
                <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                 Total
                </th>
                <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                 Total
                </th>
                <td class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                 $0.00
                </td>
               </tr>
              </tfoot>
             </table>
            </div>
           </div>
       
           <div class="mt-48 p-9">
            <div class="border-t pt-9 border-slate-200">
             <div class="text-sm font-light text-slate-700">
              <p>
               Payment terms are 14 days. Please be aware that according to the
               Late Payment of Unwrapped Debts Act 0000, freelancers are
               entitled to claim a 00.00 late fee upon non-payment of debts
               after this time, at which point a new invoice will be submitted
               with the addition of this fee. If payment of the revised invoice
               is not received within a further 14 days, additional interest
               will be charged to the overdue account and a statutory rate of
               8% plus Bank of England base of 0.5%, totalling 8.5%. Parties
               cannot contract out of the Act’s provisions.
              </p>
             </div>
            </div>
           </div>
          </div>
         </article>
        </div>
       </section>

</div>

</body>
</html>
