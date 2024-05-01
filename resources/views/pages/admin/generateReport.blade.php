<table style="border: 1px solid black" border="1">
    <tr>
        <td colspan="6" align="center" height="40">
            <h3>
                Laporan Data Pendapatan Andri Jaya Telor Bulan {{ $date }}
            </h3>
        </td>
    </tr>
    <tr>
        <th width="5" align="center" style="border: 1px solid black">No.</th>
        <th width="25" align="center" style="border: 1px solid black">Pembeli</th>
        <th width="40" align="center" style="border: 1px solid black">Barang</th>
        <th width="40" align="center" style="border: 1px solid black">Alamat</th>
        <th width="25" align="center" style="border: 1px solid black">Tanggal</th>
        <th width="20" align="center" style="border: 1px solid black">Jumlah</th>
    </tr>
    @foreach ($orders as $item)
        <tr>
            <td style="border: 1px solid black" valign="center" align="center">{{ $loop->iteration }}</td>
            <td style="border: 1px solid black" valign="center">{{ $item->user->name }}</td>
            <td style="border: 1px solid black" valign="center">
                @foreach ($item->order_items as $product)
                    <p>> {{ $product->product->name }} ({{ $product->quantity }} krat)</p>
                @endforeach

            </td>
            <td style="border: 1px solid black" valign="center">{{ $item->address }}</td>
            <td style="border: 1px solid black" valign="center" align="center">
                {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
            </td>
            <td style="border: 1px solid black" valign="center" align="right" data-format="Rp #,##0">
                {{ $item->total_price }}
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="5" align="right" height="20" valign="center">
            Total:
        </td>
        <td align="right" height="20" valign="center" data-format="Rp #,##0">
            {{ $orders->sum('total_price') }}
        </td>
    </tr>
</table>
