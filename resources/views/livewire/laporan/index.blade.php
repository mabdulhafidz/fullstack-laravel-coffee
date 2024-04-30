<div>
    <h3 class="text-lg font-semibold">Laporan Transaksi</h3>
    <div class="container mt-5">
        <div>
            <form wire:submit="getLaporan" x-data="">
                <div class="input-tanggal flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2">
                        <label for="awal" class="p-2">Tanggal Mulai</label>
                        <div class="input-group w-100 align-items-center @error('start_date') is-invalid @enderror">
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" wire:model.lazy="start_date" id="start_date">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 mt-4 md:mt-0">
                        <label for="akhir" class="p-2">Tanggal Akhir</label>
                        <div class="input-group align-items-center @error('end_date') is-invalid @enderror">
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                name="end_date" wire:model.lazy="end_date" id="end_date">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button class=bg-darkcol-md-2 my-auto bg-blue-500 text-white font-bold py-2 px-4 rounded mt-8 md:mt-0"
                        type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive mt-4">
                @if (!empty($data_laporan))
                    <a href="/laporan/exportpdf/{{ $start_date }}/{{ $end_date }}"
                        class="btn btn-dark text-end bg-black text-white py-2 px-4 rounded-md">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </a>
                @endif
                <table id="tableTransaksi" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-left">Customer</th>
                            <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                            <th class="px-6 py-3 text-left">Keterangan</th>
                            <th class="px-6 py-3 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_laporan as $transaction)
                            <tr>
                                <td>{{ $transaction->id ?? '-' }}</td>
                                <td>{{ date('Y-m-d', strtotime($transaction->date)) ?? '-' }}</td>
                                <td>{{ $transaction->customer->name ?? '-' }}</td>
                                <td>{{ $transaction->payment_method ?? '-' }}</td>
                                <td>{{ $transaction->keterangan ?? '-' }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data / Pilih tanggal</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total Pendapatan</th>
                            <th>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
