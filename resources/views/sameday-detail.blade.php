<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }
        .card-title {
            margin-bottom: 0;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .details-row {
            margin-bottom: 1rem;
        }
        .details-row strong {
            display: block;
            font-weight: 600;
        }
        .details-row .value {
            font-size: 0.875rem;
        }
        .accordion-button {
            background-color: #007bff;
            color: #fff;
        }
        .accordion-button:not(.collapsed) {
            color: #fff;
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Detail Paket</h2>
        @if($details)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">ID: {{ $details['noResi'] ?? 'N/A' }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-4">
                            <div class="details-row">
                                <strong>Nama Penerima:</strong>
                                <div class="value">{{ $details['namaPenerima'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Alamat Penerima:</strong>
                                <div class="value">{{ $details['alamatPenerima'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Contact Penerima:</strong>
                                <div class="value">{{ $details['contactPenerima'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>No Resi:</strong>
                                <div class="value">{{ $details['noResi'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Status:</strong>
                                <div class="value">{{ $details['status'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Total Checkout:</strong>
                                <div class="value">{{ number_format($details['totalCheckout'] ?? 0, 0, ',', '.') }} IDR</div>
                            </div>
                            <div class="details-row">
                                <strong>Ongkir:</strong>
                                <div class="value">{{ number_format($details['ongkir'] ?? 0, 0, ',', '.') }} IDR</div>
                            </div>
                            <div class="details-row">
                                <strong>Komisi:</strong>
                                <div class="value">{{ number_format($details['komisi'] ?? 0, 0, ',', '.') }} IDR</div>
                            </div>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col-md-4">
                            <div class="details-row">
                                <strong>Berat:</strong>
                                <div class="value">{{ $details['berat'] ?? 'N/A' }} grams</div>
                            </div>
                            <div class="details-row">
                                <strong>Tanggal Request:</strong>
                                <div class="value">{{ $details['tanggalRequest'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Tanggal Deposite:</strong>
                                <div class="value">{{ $details['tanggalDeposite'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Koordinat Penerima:</strong>
                                <div class="value">Latitude: {{ $details['koordinatPenerima']['lat'] ?? 'N/A' }}, Longitude: {{ $details['koordinatPenerima']['long'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Kelurahan Penerima:</strong>
                                <div class="value">{{ $details['kelurahanPenerima'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Deposito:</strong>
                                <div class="value">{{ $details['deposite'] ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Bukti Shipping:</strong>
                                <div class="value">{{ $details['buktiShipping'] ?? 'N/A' }}</div>
                            </div>
                            <div class="details-row">
                                <strong>Driver ID:</strong>
                                <div class="value">{{ $details['driverId'] ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">            
                            <div class="accordion mt-4" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Products
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                @if(isset($details['products']) && is_array($details['products']))
                                                    @foreach($details['products'] as $product)
                                                        <li class="list-group-item">
                                                            <strong>Product:</strong> {{ $product['product'] ?? 'N/A' }}
                                                            <br>
                                                            <strong>Quantity:</strong> {{ $product['quantity'] ?? 'N/A' }} pcs
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">No products available.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Logs
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                @if(isset($details['logs']) && is_array($details['logs']))
                                                    @foreach($details['logs'] as $log)
                                                        <li class="list-group-item">
                                                            <strong>Date:</strong> {{ $log['tanggal'] ?? 'N/A' }}
                                                            <br>
                                                            <strong>Time:</strong> {{ $log['jam'] ?? 'N/A' }}
                                                            <br>
                                                            <strong>Description:</strong> {{ $log['keterangan'] ?? 'N/A' }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">No logs available.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>Detail paket tidak ditemukan.</p>
        @endif
        <a class="btn btn-custom mt-4" href="/merchant/paket-instan" role="button">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
