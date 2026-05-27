<table>
    <thead>
        <tr>
            <th colspan="3"><b>Laporan Penjualan Dapur Bunda Bahagia</b></th>
        </tr>
        <tr>
            <th colspan="3">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</th>
        </tr>
        <tr>
            <th><b>Tanggal</b></th>
            <th><b>Jumlah Order</b></th>
            <th><b>Total Penjualan (Rp)</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dailySales as $sale)
            <tr>
                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                <td>{{ $sale->orders }}</td>
                <td>{{ $sale->sales }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
