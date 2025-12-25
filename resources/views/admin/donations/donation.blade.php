<!DOCTYPE html>
<html>
<head>
    <title>Laporan Donasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DONASI MASJID</h2>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Donatur</th>
                <th>Tipe</th>
                <th>Kebutuhan Barang</th>
                <th>Jumlah / Nominal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $donation->nama_donatur }}</td>
                <td>{{ ucfirst($donation->jenis_donasi) }}</td>
                <td>{{ $donation->need->nama_barang ?? '-' }}</td>
                <td>
                    @if($donation->jenis_donasi == 'uang')
                        Rp {{ number_format($donation->nominal, 0, ',', '.') }}
                    @else
                        {{ $donation->jumlah_barang }} Unit
                    @endif
                </td>
                <td>{{ $donation->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Donasi Tunai:</th>
                <th colspan="2">Rp {{ number_format($totalAmount, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak secara otomatis oleh Sistem Donasi Masjid</p>
    </div>
</body>
</html>