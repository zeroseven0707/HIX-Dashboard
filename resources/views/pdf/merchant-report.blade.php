<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Merchant</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        h4 { text-align: center; }
    </style>
</head>
<body>
    <h4>Detail Laporan Merchant - {{ $details['merchant']['bussinesName'] }}</h4>
    <table>
        <tr>
            <th>Total Paket</th>
            <td>{{ $details['totalPackages'] ?? '0' }}</td>
        </tr>
        <tr>
            <th>Total Pendapatan</th>
            <td>Rp. {{ number_format($details['totalIncome'], 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Cashback</th>
            <td>Rp. {{ number_format($details['totalCashback'], 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Keseluruhan</th>
            <td>Rp. {{ number_format($details['totalOverall'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <h4>Informasi Merchant</h4>
    <table>
        <tr>
            <th>Nama Pemilik</th>
            <td>{{ $details['merchant']['bussinesOwener'] }}</td>
        </tr>
        <tr>
            <th>Nomor HP</th>
            <td>{{ $details['merchant']['nomorHp'] }}</td>
        </tr>
        <tr>
            <th>Jenis Usaha</th>
            <td>{{ $details['merchant']['JenisUsaha']['jenisUsaha'] }} ({{ $details['merchant']['JenisUsaha']['singkatan'] }})</td>
        </tr>
        <tr>
            <th>Kategori Usaha</th>
            <td>{{ $details['merchant']['KategoriUsaha']['kategori'] }}</td>
        </tr>
    </table>

    <h4>Informasi Rekening</h4>
    <table>
        <tr>
            <th>Bank</th>
            <td>{{ $details['rekening']['bank'] }}</td>
        </tr>
        <tr>
            <th>No. Rekening</th>
            <td>{{ $details['rekening']['noRekening'] }}</td>
        </tr>
        <tr>
            <th>Atas Nama</th>
            <td>{{ $details['rekening']['nama'] }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                {{ $details['rekening']['active'] ? 'Aktif' : 'Tidak Aktif' }}
            </td>
        </tr>
    </table>
</body>
</html>
