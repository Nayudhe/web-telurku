<h3>
    <center>Laporan Data Pendapatan Telurku Bulan {{ $date }}</center>
</h3>
<table style="width: 100%; margin-top: 50px" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama Pembeli</th>
        <th>Barang</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
    </tr>
    @foreach ($orders as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->name }}</td>
            <td>
                <ul>
                    @foreach ($item->order_items as $product)
                        <li>{{ $product->product->name }} ({{ $product->quantity }} kg)</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
            <td style="text-align: right">Rp {{ number_format($item->total_price, 0, '', '.') }}</td>
        </tr>
    @endforeach
</table>
<hr style="margin-top: 20px">
<div style="display: flex; padding-right: 5px">
    <p style="text-align: right">
        Total: Rp {{ number_format($orders->sum('total_price'), 0, '', '.') }}
    </p>
</div>
