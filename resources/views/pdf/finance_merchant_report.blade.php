<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Finance Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Merchant Finance Report</h2>

    <table>
        <tr>
            <th>Total Uang Semua Merchant</th>
            <td>Rp. {{ number_format($totalUangSemuaMerchant, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3>Merchant List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Business Name</th>
                <th>Total Paket</th>
                <th>Pendapatan</th>
                <th>Cashback</th>
                <th>Pendapatan Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($merchants as $merchant)
            <tr>
                <td>{{ $merchant['merchant']['id'] }}</td>
                <td>{{ $merchant['merchant']['bussinesName'] }}</td>
                <td>{{ $merchant['total_paket'] }}</td>
                <td>Rp. {{ number_format($merchant['pendapatan'], 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($merchant['cashback'], 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($merchant['pendapatanTotal'], 0, ',', '.') }}</td>
                <td>{{ $merchant['status'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
