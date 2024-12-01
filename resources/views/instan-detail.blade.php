<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="{{ asset('fobia/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: #009E96;
            color: #fff;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }

        .card-title {
            margin-bottom: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-custom {
            background-color: #009E96;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #00877D;
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
            background-color: #009E96;
            color: #fff;
        }

        .accordion-button:not(.collapsed) {
            color: #fff;
            background-color: #00877D;
        }

        #map {
            height: 400px;
            border: 1px solid black;
            border-radius: 8px;
        }

        .icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
    </style>
            <!-- Include Font Awesome -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2 class="mb-4">Detail Paket</h2>
            <a class="" href="/merchant/paket-instan" role="button"><button class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</button> </a>
        </div>

        @if ($details)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">No Resi: {{ $details['noResi'] ?? 'N/A' }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach (['Nama Penerima' => 'namaPenerima', 'Alamat Penerima' => 'alamatPenerima', 'Contact Penerima' => 'contactPenerima', 'Status' => 'status', 'Total Checkout' => 'totalCheckout', 'Ongkir' => 'ongkir', 'Komisi' => 'komisi'] as $label => $field)
                                            <div class="col col-md-6">
                                                <div class="details-row">
                                                    <strong>{{ $label }}:</strong>
                                                    <div class="value">
                                                        {{ $field === 'totalCheckout' || $field === 'ongkir' || $field === 'komisi' ? number_format($details[$field] ?? 0, 0, ',', '.') . ' IDR' : $details[$field] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <span class="icon">&#128722;</span> Products
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-group">
                                                        @if (isset($details['products']) && is_array($details['products']))
                                                            @foreach ($details['products'] as $product)
                                                                <li class="list-group-item">
                                                                    <strong>Product:</strong> {{ $product['product'] ?? 'N/A' }}
                                                                    <br>
                                                                    <strong>Quantity:</strong>
                                                                    {{ $product['quantity'] ?? 'N/A' }} pcs
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
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <span class="icon">&#128196;</span> Logs
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="list-group">
                                                        @if (isset($details['logs']) && is_array($details['logs']))
                                                            @foreach ($details['logs'] as $log)
                                                                <li class="list-group-item">
                                                                    <strong>Date:</strong> {{ $log['tanggal'] ?? 'N/A' }}
                                                                    <br>
                                                                    <strong>Time:</strong> {{ $log['jam'] ?? 'N/A' }}
                                                                    <br>
                                                                    <strong>Description:</strong>
                                                                    {{ $log['keterangan'] ?? 'N/A' }}
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
                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach (['Berat' => 'berat', 'Tanggal Request' => 'tanggalRequest', 'Tanggal Deposite' => 'tanggalDeposite', 'Koordinat Penerima' => 'koordinatPenerima', 'Kelurahan Penerima' => 'kelurahanPenerima', 'Deposito' => 'deposite', 'Bukti Shipping' => 'buktiShipping', 'Driver ID' => 'driverId'] as $label => $field)
                                            <div class="col col-md-6">
                                                <div class="details-row">
                                                    <strong>{{ $label }}:</strong>
                                                    <div class="value">
                                                        {{ $field === 'koordinatPenerima' ? 'Latitude: ' . ($details[$field]['lat'] ?? 'N/A') . ', Longitude: ' . ($details[$field]['long'] ?? 'N/A') : ($field === 'deposite' ? ($details[$field] ? 'Yes' : 'No') : $details[$field] ?? 'N/A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="map" class="mb-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger">Detail paket tidak ditemukan.</div>
        @endif
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var latitude = {{ $details['koordinatPenerima']['lat'] ?? -7.353083395388788 }};
            var longitude = {{ $details['koordinatPenerima']['long'] ?? 108.22390578662055 }};
            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map);

            function updateInputs(lat, long) {
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = long;
            }

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var long = e.latlng.lng;

                marker.setLatLng([lat, long]);
                updateInputs(lat, long);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
