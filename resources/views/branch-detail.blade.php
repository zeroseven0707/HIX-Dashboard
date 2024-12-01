<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            position: relative;
            background-color: #343a40;
            color: #fff;
            padding: 3rem 0;
            text-align: center;
        }
        .profile-header .img-container {
            width: 150px;
            height: 150px;
            border: 5px solid #fff;
            border-radius: 50%;
            overflow: hidden; /* Mengatasi gambar keluar dari kontainer */
            margin: 0 auto;
        }
        .profile-header img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Memastikan gambar tetap proporsional */
        }
        .profile-info {
            margin-top: -5rem;
        }
        .profile-info .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        #map {
            height: 400px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div class="profile-header">
        <div class="position-relative d-inline-block img-container">
            <img src="{{ asset(env('API_BASE_URL_ORIGIN'). $branch['Merchant']['logo']) }}" alt="Merchant Logo" class="img-fluid">
        </div>
        <h1>{{ $branch['Merchant']['bussinesName'] }}</h1>
    </div>

    <div class="container profile-info">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>PIC</th>
                                    <td>{{ $branch['pic'] }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $branch['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>{{ $branch['contact'] }}</td>
                                </tr>
                                <tr>
                                    <th>Province</th>
                                    <td>{{ $branch['Provinsi']['provinsi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Regency</th>
                                    <td>{{ $branch['Kabupaten']['kabupaten'] }}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{ $branch['Kecamatan']['kecamatan'] }}</td>
                                </tr>
                                <tr>
                                    <th>Sub-district</th>
                                    <td>{{ $branch['kelurahan'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="map"></div>
                        <div class="text-center">
                            <a href="/merchant-cabang" class="btn btn-primary mt-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var latitude = {{ $branch['koordinat']['lat'] }};
            var longitude = {{ $branch['koordinat']['long'] }};
            var map = L.map('map').setView([latitude, longitude], 13);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
    
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Latitude: ' + latitude + '<br>Longitude: ' + longitude)
                .openPopup();
        });
    </script>
</body>
</html>
