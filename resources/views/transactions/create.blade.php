
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('transactions.index') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="customer_id" class="block text-gray-600">Pelanggan</label>
                        <select name="customer_id" id="customer_id" class="form-select mt-1 block w-full" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="employee_id" class="block text-gray-600">Pegawai</label>
                        <select name="employee_id" id="employee_id" class="form-select mt-1 block w-full" required>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-600">Keterangan</label>
                        <input type="text" name="description" id="description" class="form-input mt-1 block w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="transaction_date" class="block text-gray-600">Tanggal Transaksi</label>
                        <input type="date" name="transaction_date" id="transaction_date" class="form-input mt-1 block w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-600">Total Harga</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-input mt-1 block w-full" required />
                    </div>

                    <!-- You can add other fields related to items if needed -->

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>