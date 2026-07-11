<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran Byte & Brew</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #faf8f5;
            color: #404040;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border: 1px solid #ebdcb9;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #20622c;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .order-details {
            display: table;
            width: 100%;
            border-bottom: 2px dashed #ebdcb9;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .order-details-row {
            display: table-row;
        }
        .order-details-cell {
            display: table-cell;
            padding: 5px 0;
            font-size: 14px;
        }
        .order-details-cell.label {
            color: #8c8c8c;
            font-weight: 600;
            width: 50%;
        }
        .order-details-cell.value {
            text-align: right;
            font-weight: 700;
            color: #262626;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            text-align: left;
            font-size: 12px;
            color: #8c8c8c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ebdcb9;
            padding-bottom: 10px;
        }
        .items-table td {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }
        .items-table .item-name {
            font-weight: 600;
            color: #262626;
        }
        .items-table .item-quantity {
            color: #8c8c8c;
            margin-left: 5px;
        }
        .items-table .item-price {
            text-align: right;
            font-weight: 700;
            color: #262626;
        }
        .totals-section {
            background-color: #faf8f5;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }
        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .total-row:last-child {
            margin-bottom: 0;
            margin-top: 10px;
            border-t: 1px solid #ebdcb9;
            padding-top: 10px;
        }
        .total-cell {
            display: table-cell;
            font-size: 14px;
        }
        .total-cell.label {
            color: #8c8c8c;
        }
        .total-cell.value {
            text-align: right;
            font-weight: 700;
            color: #262626;
        }
        .total-row.grand-total .total-cell.label {
            font-size: 16px;
            font-weight: 700;
            color: #262626;
        }
        .total-row.grand-total .total-cell.value {
            font-size: 18px;
            font-weight: 700;
            color: #20622c;
        }
        .footer {
            text-align: center;
            padding: 20px 30px 40px 30px;
            font-size: 12px;
            color: #8c8c8c;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Byte & Brew Coffee & Eatery</h1>
            <p>Universitas Dr. Soetomo Surabaya</p>
        </div>
        
        <div class="content">
            <div style="text-align: center; margin-bottom: 25px;">
                <span style="font-size: 18px; font-weight: 700; color: #20622c; display: block;">TERIMA KASIH!</span>
                <span style="font-size: 13px; color: #8c8c8c;">Pemesanan Dine-In Anda telah sukses diproses</span>
            </div>

            <div class="order-details">
                <div class="order-details-row">
                    <div class="order-details-cell label">ID PESANAN</div>
                    <div class="order-details-cell value">{{ $order->order_code }}</div>
                </div>
                <div class="order-details-row">
                    <div class="order-details-cell label">NAMA PELANGGAN</div>
                    <div class="order-details-cell value">{{ $order->customer_name }}</div>
                </div>
                <div class="order-details-row">
                    <div class="order-details-cell label">NOMOR MEJA</div>
                    <div class="order-details-cell value">Meja {{ sprintf('%02d', $order->table_number) }}</div>
                </div>
                <div class="order-details-row">
                    <div class="order-details-cell label">WAKTU TRANSAKSI</div>
                    <div class="order-details-cell value">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</div>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Daftar Item</th>
                        <th style="text-align: right;">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <span class="item-name">{{ $item->menu->name }}</span>
                                <span class="item-quantity">x{{ $item->quantity }}</span>
                            </td>
                            <td class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals-section">
                <div class="total-row">
                    <div class="total-cell label">Subtotal</div>
                    <div class="total-cell value">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</div>
                </div>
                <div class="total-row">
                    <div class="total-cell label">Pajak PB1 (10%)</div>
                    <div class="total-cell value">Rp {{ number_format($order->tax, 0, ',', '.') }}</div>
                </div>
                <div class="total-row grand-total">
                    <div class="total-cell label">Total Pembayaran</div>
                    <div class="total-cell value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                </div>
                <div class="total-row" style="margin-top: 10px; border-top: 1px solid #ebdcb9; padding-top: 10px;">
                    <div class="total-cell label">Metode Pembayaran</div>
                    <div class="total-cell value">
                        @if ($order->payment_method === 'cash')
                            Tunai di Kasir
                        @elseif ($order->payment_method === 'qris')
                            QRIS (Instant)
                        @else
                            Transfer Bank
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Byte & Brew Coffee & Eatery &copy; 2026</p>
            <p>Jika ada kendala pemesanan, silakan tunjukkan ID Pesanan ini ke kasir kami.</p>
        </div>
    </div>
</body>
</html>