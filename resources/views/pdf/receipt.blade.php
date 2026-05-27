<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Struk - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #0F172A;
        }
        .container {
            max-width: 280px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 16px;
            border-bottom: 1px dashed #0F172A;
            padding-bottom: 12px;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .header p {
            font-size: 10px;
        }
        .info {
            margin-bottom: 12px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .info-row span:first-child {
            width: 80px;
        }
        .info-row span:last-child {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        th, td {
            padding: 4px 0;
            text-align: left;
        }
        th { border-bottom: 1px dashed #0F172A; }
        .qty { width: 30px; }
        .price { text-align: right; width: 70px; }
        .total-row td {
            border-top: 1px dashed #0F172A;
            padding-top: 6px;
            font-weight: bold;
        }
        .total-row td:last-child { text-align: right; }
        .tax-row td {
            padding-top: 4px;
            font-size: 11px;
        }
        .tax-row td:last-child { text-align: right; }
        .grand-total {
            background: #0F172A;
            color: white;
            padding: 8px;
            text-align: center;
            margin-bottom: 12px;
        }
        .grand-total span:last-child {
            font-size: 16px;
            font-weight: bold;
        }
        .payment-info {
            margin-bottom: 12px;
            padding: 8px;
            background: #F8FAFC;
            border: 1px dashed #0F172A;
        }
        .payment-info .row {
            display: flex;
            justify-content: space-between;
        }
        .items {
            margin-bottom: 12px;
        }
        .item-note {
            font-size: 10px;
            color: #64748B;
            font-style: italic;
            padding-left: 30px;
        }
        .footer {
            text-align: center;
            border-top: 1px dashed #0F172A;
            padding-top: 12px;
            font-size: 10px;
        }
        .footer p { margin-bottom: 4px; }
        .separator { border-top: 1px dashed #0F172A; margin: 8px 0; }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h1>DAPUR BUNDA</h1>
            <p>Jl. Makanan Enak No. 123</p>
            <p>Telp: 021-1234567</p>
        </div>

        <div class="info">
            <div class="info-row">
                <span>No. Order</span>
                <span>{{ $order->order_number }}</span>
            </div>
            <div class="info-row">
                <span>Tanggal</span>
                <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span>Kasir</span>
                <span>{{ $order->cashier->name ?? 'N/A' }}</span>
            </div>
            @if($order->table)
            <div class="info-row">
                <span>Meja</span>
                <span>{{ $order->table->number }}</span>
            </div>
            @endif
        </div>

        <div class="separator"></div>

        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="qty">Qty</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="qty">{{ $item->qty }}</td>
                    <td class="price">{{ number_format($item->price * $item->qty, 0, '', '.') }}</td>
                </tr>
                @if($item->note)
                <tr>
                    <td colspan="3" class="item-note">* {{ $item->note }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

        <div class="grand-total">
            <div style="display: flex; justify-content: space-between;">
                <span>TOTAL</span>
                <span>Rp {{ number_format($grandTotal, 0, '', '.') }}</span>
            </div>
        </div>

        @if($transaction)
        <div class="payment-info">
            <div class="row">
                <span>Metode Bayar</span>
                <span>{{ $transaction->payment_method }}</span>
            </div>
            @if($transaction->payment_method === 'Tunai')
            <div class="row">
                <span>Bayar</span>
                <span>Rp {{ number_format($transaction->amount_received, 0, '', '.') }}</span>
            </div>
            <div class="row">
                <span>Kembalian</span>
                <span>Rp {{ number_format($transaction->change, 0, '', '.') }}</span>
            </div>
            @endif
        </div>
        @endif

        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
            <p style="margin-top: 8px;">--- STRUK INI ADALAH BUKTI PEMBAYARAN SAH ---</p>
        </div>
    </div>
</body>
</html>