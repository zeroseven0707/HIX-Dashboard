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
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
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
                <form wire:submit.prevent="createBranch">
                    <div class="mb-3">
                        <label for="pic" class="form-label">PIC</label>
                        <input type="text" class="form-control" id="pic" wire:model="pic">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="contact" wire:model="contact">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" wire:model="alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="lat" wire:model="koordinat.lat">
                    </div>
                    <div class="mb-3">
                        <label for="long" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="long" wire:model="koordinat.long">
                    </div>
                    <div id="map" class="mb-3"></div>
                    <div>
                        <label for="provinsi">Provinsi</label>
                        <select id="provinsi" wire:model="provinsiId" class="form-control" wire:change="loadKabupaten">
                            <option value="">Pilih Provinsi</option>
                            @foreach($province as $prov)
                                <option value="{{ $prov['id'] }}">{{ $prov['provinsi'] }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    @if (!empty($kabupaten))
                        <div>
                            <label for="kabupaten">Kabupaten</label>
                            <select id="kabupaten" class="form-control" wire:model="kabupatenId" wire:change="loadKecamatan">
                                <option value="">Pilih Kabupaten</option>
                                @foreach($kabupaten as $kab)
                                    <option value="{{ $kab['id'] }}">{{ $kab['kabupaten'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                
                    @if (!empty($kecamatan))
                        <div>
                            <label for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" class="form-control" wire:model="kecamatanId">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($kecamatan as $kec)
                                    <option value="{{ $kec['id'] }}">{{ $kec['kecamatan'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="kelurahan" wire:model="kelurahan">
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
                                {{-- @dd($branch['id']) --}}
                                <td>{{ $branch['id'] }}</td>
                                <td>{{ $branch['pic'] }}</td>
                                <td>{{ $branch['contact'] }}</td>
                                <td>{{ $branch['alamat'] }}</td>
                                <td>
                                    <a href="/branch-detail/{{ $branch['id'] }}">
                                        <button class="btn btn-primary">View Detail</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var latitude = {{ $koordinat['lat'] ?? -7.353083395388788 }};
            var longitude = {{ $koordinat['long'] ?? 108.22390578662055 }};
            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map);

            function updateInputs(lat, long) {
                Livewire.emit('updateCoordinates', lat, long);
            }

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var long = e.latlng.lng;

                marker.setLatLng([lat, long]);
                updateInputs(lat, long);
            });

            Livewire.on('coordinatesUpdated', function(lat, long) {
                marker.setLatLng([lat, long]);
                map.setView([lat, long], 13);
            });
        });
    </script>
</body>
</html>
