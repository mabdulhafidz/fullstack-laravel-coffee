<form action="{{ route('transaction.store') }}" method="post">
    @csrf
    <input type="text" name="customer_name" placeholder="Customer Name" required>
    <select name="menu_id" required>
        <!-- Opsi menu diisi dengan data dari database -->
    </select>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Submit</button>
</form>

<!-- Daftar Transaksi -->
<table>
    <tr>
        <th>Keterangan</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
    </tr>
    @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->Keterangan }}</td>
            <td>{{ $transaction->menu->total_harga }}</td>
            <td>{{ $transaction->tanggal }}</td>
        </tr>
    @endforeach
</table>