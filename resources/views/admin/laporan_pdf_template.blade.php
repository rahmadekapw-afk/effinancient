<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">LAPORAN ARUS KAS KOPERASI</h2>
    <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Masuk (Rp)</th>
                <th>Keluar (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arus_kas as $item)
            <tr>
                <td>{{ $item['tanggal']->format('d/m/Y') }}</td>
                <td>{{ $item['keterangan'] }}</td>
                <td class="text-right">{{ number_format($item['masuk'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item['keluar'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-bold">
                <td colspan="2"><strong>TOTAL SALDO AKHIR</strong></td>
                <td colspan="2" class="text-right"><strong>Rp {{ number_format($saldo_akhir, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>