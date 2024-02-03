
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(isset($transaction))
                <table class="table">
                    <tr>
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
                            <a href="{{ route('transactions.show', ['id' => 1]) }}">Show Transaction</a>
                        </td>
                    </tr>
                </table>
            @else
                <p>Transaksi tidak ditemukan.</p>
            @endif
        </div>
    </div>
</x-guest-layout>