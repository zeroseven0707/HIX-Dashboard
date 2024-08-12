<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Cabang Baru</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <style>
        #map {
            height: 400px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    
        <h2>Buat Cabang Baru</h2>
        <form action="{{ route('branches.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="pic" class="form-label">PIC</label>
                <input type="text" class="form-control" id="pic" name="pic">
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="contact" name="contact">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat"></textarea>
            </div>
                <input type="hidden" class="form-control" id="lat" name="koordinat_lat" readonly>
                <input type="hidden" class="form-control" id="long" name="koordinat_long" readonly>
            <div id="map" class="mb-3"></div>
            <div class="mb-3">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" name="provinsiId" class="form-control" onchange="loadKabupaten(this.value)">
                    <option value="">Pilih Provinsi</option>
                    @foreach($province as $prov)
                        <option value="{{ $prov['id'] }}">{{ $prov['provinsi'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kabupaten">Kabupaten</label>
                <select id="kabupaten" name="kabupatenId" class="form-control" onchange="loadKecamatan(this.value)">
                    <option value="">Pilih Kabupaten</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" name="kecamatanId" class="form-control">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <input type="text" class="form-control" id="kelurahan" name="kelurahan">
            </div>
            <button type="submit" class="btn btn-primary">Daftar Cabang</button>
        </form>
    </div>
    
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pic</th>
                    <th>Contact</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch['id'] }}</td>
                        <td>{{ $branch['pic'] }}</td>
                        <td>{{ $branch['contact'] }}</td>
                        <td>{{ $branch['alamat'] }}</td>
                        <td>
                            <a href="{{ route('branch.detail', ['branchId' => $branch['id']]) }}">
                                <button class="btn btn-primary">View Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var latitude = {{ $koordinat['lat'] ?? -7.353083395388788 }};
            var longitude = {{ $koordinat['long'] ?? 108.22390578662055 }};
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

        function loadKabupaten(provinsiId) {
            fetch(`/load-kabupaten?provinsiId=${provinsiId}`)
                .then(response => response.json())
                .then(data => {
                    let kabupatenSelect = document.getElementById('kabupaten');
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    data.forEach(kabupaten => {
                        let option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.kabupaten;
                        kabupatenSelect.appendChild(option);
                    });
                });
        }

        function loadKecamatan(kabupatenId) {
            fetch(`/load-kecamatan?kabupatenId=${kabupatenId}`)
                .then(response => response.json())
                .then(data => {
                    let kecamatanSelect = document.getElementById('kecamatan');
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(kecamatan => {
                        let option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.kecamatan;
                        kecamatanSelect.appendChild(option);
                    });
                });
        }
    </script>
</body>
</html>
