<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333; /* Warna teks */
        }
        h2 {
            text-align: center;
            color: #007bff; /* Warna judul */
        }
        p {
            text-align: center;
            font-size: 1.1em;
            color: #666; /* Warna keterangan */
        }
        .finance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px; /* Sudut membulat */
            overflow: hidden; /* Menghindari overflow */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan tabel */
        }
        .finance-table th, .finance-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #dee2e6; /* Batas untuk semua sel */
        }
        .finance-table th {
            background-color: #f7f9fc; /* Warna latar belakang header */
            color: #007bff; /* Warna teks header */
            font-weight: bold;
        }
        .finance-table tr:nth-child(even) {
            background-color: #e9f5ff; /* Warna latar belakang untuk baris genap */
        }
        .finance-table tr:nth-child(odd) {
            background-color: #ffffff; /* Warna latar belakang untuk baris ganjil */
        }
        .finance-table tr:hover {
            background-color: #d0e7ff; /* Warna saat hover */
        }
        .total {
            font-weight: bold;
            font-size: 1.1em;
            color: gray; /* Warna untuk total */
        }

        /* Gaya untuk tabel Driver List */
        .driver-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px; /* Sudut membulat */
            overflow: hidden; /* Menghindari overflow */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan tabel */
        }
        .driver-table th, .driver-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #dee2e6; /* Batas untuk semua sel */
        }
        .driver-table th {
            background-color: #007bff; /* Warna biru untuk header */
            color: white; /* Warna teks header */
            font-weight: bold;
        }
        .driver-table tr:nth-child(even) {
            background-color: #f2f9fc; /* Warna latar belakang untuk baris genap */
        }
        .driver-table tr:nth-child(odd) {
            background-color: #ffffff; /* Warna latar belakang untuk baris ganjil */
        }
        .driver-table tr:hover {
            background-color: #d0e7ff; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <h2>Finance Report</h2>

    <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>

    <table class="finance-table">
        <tr>
            <th>Pendapatan Kotor</th>
            <td class="total">Rp. {{ number_format($pendapatanKotor, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Cashback</th>
            <td class="total">Rp. {{ number_format($totalCashback, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Komisi Driver</th>
            <td class="total">Rp. {{ number_format($totalkomisiDriver, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Pendapatan Bersih</th>
            <td class="total">Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Pemasukan Paket COD</th>
            <td class="total">{{ number_format($TotalPaketCOD, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Shippings</th>
            <td class="total">{{ $totalShippings }}</td>
        </tr>
        <tr>
            <th>Total Paket</th>
            <td class="total">{{ number_format($totalPaketLUNAS, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3>Driver List</h3>
    <table class="driver-table">
        <thead>
            <tr>
                <th>Nama Driver</th>
                <th>Total COD</th>
                <th>Total Paid</th>
                <th>COD Deposit</th>
                <th>Paid Deposit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
            <tr>
                <td>{{ $driver['driverName'] }}</td>
                <td>{{ $driver['totalCod'] }}</td>
                <td>{{ $driver['totalPaid'] }}</td>
                <td>Rp. {{ number_format($driver['codDeposits'], 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($driver['paidDeposits'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
