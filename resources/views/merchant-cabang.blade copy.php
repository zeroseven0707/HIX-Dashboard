<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Cabang Baru</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('fobia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/icons.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 400px;
            border: 1px solid black;
        }

        .alamat-column {
            max-width: 200px;
            /* Tentukan lebar maksimum untuk kolom alamat */
            word-wrap: break-word;
            /* Bungkus kata panjang ke baris berikutnya */
            white-space: normal;
            /* Izinkan teks untuk membungkus */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <!-- Tombol Back -->
        <div class="d-flex justify-content-between mb-3">
            <h3>Cabang Merchant</h3>
            <a href="/merchant/paket-instan"> <button class="btn btn-outline-secondary"><i
                        class="fas fa-arrow-left"></i> Kembali</button></a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h6>Daftar Cabang</h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Pic</th>
                                            <th>Contact</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $branch)
                                            <tr>
                                                {{-- <td>{{ $branch['id'] }}</td> --}}
                                                <td>{{ $branch['pic'] }}</td>
                                                <td>{{ $branch['contact'] }}</td>
                                                <td class="alamat-column">{{ $branch['alamat'] }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('branch.detail', ['branchId' => $branch['id']]) }}">
                                                        <button class="btn btn-primary btn-sm">View Detail</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination Controls -->
                                {{-- <div class="pagination-controls mt-4">
                                    <button class="btn btn-secondary" {{ $currentPage == 1 ? 'disabled' : '' }}
                                        wire:click="fetchDrivers({{ $currentPage - 1 }})">
                                        Previous
                                    </button>
                
                                    <span>Page {{ $currentPage }} of {{ $totalPages }}</span>
                
                                    <button class="btn btn-secondary" {{ $currentPage == $totalPages ? 'disabled' : '' }}
                                        wire:click="fetchDrivers({{ $currentPage + 1 }})">
                                        Next
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-5">
                        @if (session()->has('message'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: '{{ session('message') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            </script>
                        @endif

                        @if (session()->has('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ session('error') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            </script>
                        @endif
                        <div class="card">

                            <div class="card-body">
                                <h6>Tambah Cabang</h6>
                                <form action="{{ route('branches.create') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="pic" class="form-label">PIC</label>
                                                <input type="text" class="form-control" id="pic"
                                                    name="pic">
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="contact" class="form-label">Kontak</label>
                                                <input type="text" class="form-control" id="contact"
                                                    name="contact">
                                            </div>
                                        </div>
                                        <div class="col col-md-12">
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="provinsi">Provinsi</label>
                                                <select id="provinsi" name="provinsiId" class="form-control"
                                                    onchange="loadKabupaten(this.value)">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($province as $prov)
                                                        <option value="{{ $prov['id'] }}">{{ $prov['provinsi'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="kabupaten">Kabupaten</label>
                                                <select id="kabupaten" name="kabupatenId" class="form-control"
                                                    onchange="loadKecamatan(this.value)">
                                                    <option value="">Pilih Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select id="kecamatan" name="kecamatanId" class="form-control">
                                                    <option value="">Pilih Kecamatan</option>
                                                    {{-- Pastikan untuk menambahkan data lat dan long untuk setiap opsi --}}
                                                    {{-- @foreach ($kecamatan as $kec) --}}
                                                        <option value="2"
                                                            data-lat="-7.366067003699387"
                                                            data-long="108.09983979340981">
                                                            Mangunreja
                                                        </option>
                                                        <option value="2"
                                                            data-lat="-7.346629297090453"
                                                            data-long="108.21421542188415">
                                                            Tasik
                                                        </option>
                                                        <option value="2"
                                                            data-lat="-7.517400630339682"
                                                            data-long="108.16668792641741">
                                                            Cibalong
                                                        </option>
                                                        <option value="2"
                                                            data-lat="-7.3503831023015"
                                                            data-long="108.12504583081292">
                                                            Singaparna
                                                        </option>
                                                    {{-- @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="mb-3">
                                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                                <input type="text" class="form-control" id="kelurahan"
                                                    name="kelurahan">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="lat" name="koordinat_lat"
                                        readonly>
                                    <input type="hidden" class="form-control" id="long" name="koordinat_long"
                                        readonly>
                                    <div id="map" class="mb-3"></div>
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Tambah Cabang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container mt-5">
    </div>

    <div class="container mt-4">



    </div> --}}

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Tambahkan event listener untuk mengubah peta saat kecamatan dipilih
            document.getElementById('kecamatan').addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Ambil lat dan long dari data yang tersimpan
                    let lat = selectedOption.dataset.lat;
                    let long = selectedOption.dataset.long;

                    // Ubah tampilan peta dengan animasi
                    map.flyTo([lat, long], 15, {
                        duration: 2
                    }); // 15 adalah level zoom yang diinginkan, durasi 2 detik
                    marker.setLatLng([lat, long]); // Memindahkan marker ke lokasi baru
                }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
