<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 14px; margin: 0; padding: 20px; color: #000; }
        .struk-container { width: 80mm; margin: 0 auto; background: #fff; }
        .header { text-align: center; margin-bottom: 15px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .header h2 { margin: 0 0 5px 0; font-size: 18px; }
        .header p { margin: 0; font-size: 12px; }
        .info { margin-bottom: 10px; font-size: 12px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .info table { width: 100%; }
        .info td { vertical-align: top; }
        .info .right { text-align: right; }
        .items { width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size: 12px; border-bottom: 1px dashed #000; }
        .items th, .items td { padding: 4px 0; }
        .items .right { text-align: right; }
        .items .center { text-align: center; }
        .total { width: 100%; font-size: 14px; font-weight: bold; margin-bottom: 15px; }
        .total td { padding: 4px 0; }
        .total .right { text-align: right; }
        .footer { text-align: center; font-size: 12px; border-top: 1px dashed #000; padding-top: 10px; }
        @media print {
            body { padding: 0; }
            @page { margin: 0; size: 80mm auto; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="struk-container">
        <div class="header">
            <h2>APOTEK SYSTEM</h2>
            <p>Jl. Kesehatan No. 123, Kota Sehat</p>
            <p>Telp: (021) 12345678</p>
        </div>
        
        <div class="info">
            <table>
                <tr>
                    <td>Tgl</td>
                    <td>:</td>
                    <td class="right">{{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>:</td>
                    <td class="right">TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>:</td>
                    <td class="right">{{ $transaksi->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Pasien</td>
                    <td>:</td>
                    <td class="right">{{ $transaksi->nama_pasien }}</td>
                </tr>
            </table>
        </div>
        
        <table class="items">
            <thead>
                <tr>
                    <th style="text-align: left;">Item</th>
                    <th class="center">Qty</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detail_transaksis as $detail)
                <tr>
                    <td colspan="3">{{ $detail->obat->nama_obat ?? 'Obat' }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 10px;">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="center">x{{ $detail->qty }}</td>
                    <td class="right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <table class="total">
            <tr>
                <td>TOTAL</td>
                <td class="right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr style="font-size: 12px; font-weight: normal;">
                <td>Status</td>
                <td class="right">{{ strtoupper($transaksi->status_pembayaran) }}</td>
            </tr>
        </table>
        
        <div class="footer">
            <p>Terima Kasih</p>
            <p>Semoga Lekas Sembuh</p>
        </div>
    </div>
</body>
</html>
