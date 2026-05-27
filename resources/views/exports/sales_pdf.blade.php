<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Penjualan Dapur Bunda Bahagia</h2>
    <p class="text-center">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th class="text-center">Jumlah Order</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalOrders = 0;
                $totalSales = 0;
            @endphp
            @forelse($dailySales as $sale)
                @php
                    $totalOrders += $sale->orders;
                    $totalSales += $sale->sales;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                    <td class="text-center">{{ $sale->orders }}</td>
                    <td class="text-right">Rp {{ number_format($sale->sales, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th class="text-center">{{ $totalOrders }}</th>
                <th class="text-right">Rp {{ number_format($totalSales, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
