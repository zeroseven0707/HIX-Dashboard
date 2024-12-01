<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Request Instan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS Files -->
    <link href="{{ asset('fobia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fobia/css/icons.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h4 {
            margin-bottom: 20px;
        }

        #map {
            height: 400px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-top: 15px;
        }

       
    </style>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <div class="container mt-5 mb-5">
        <!-- Tombol Back -->
        <div class="d-flex justify-content-between mb-3">
            <h3>Tambah Request Baru</h3>
            <a href="/merchant/paket-instan"> <button class="btn btn-outline-secondary"><i
                        class="fas fa-arrow-left"></i> Kembali</button></a>
        </div>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    html: "{!! session('success') !!}",
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    html: "{!! session('error') !!}", // Use `html` to allow multiline messages
                    confirmButtonText: 'OK'
                });
            </script>
        @endif


        <form action="{{ route('instant-submit') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">

                        <div class="col col-md-12 mb-3 p-2">
                            <div class="card">
                                <div class="card-body shadow">
                                    <h4>Produk</h4>
                                    @foreach (session('products', []) as $index => $product)
                                        <div class="row mb-3 align-items-center">
                                            <div class="col-md-6">
                                                <input type="text" name="products[{{ $index }}][product]"
                                                    class="form-control" value="{{ $product['product'] }}"
                                                    placeholder="Nama Produk">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="decreaseQuantity({{ $index }})">-</button>
                                                    </div>
                                                    <input type="text" id="quantity-{{ $index }}"
                                                        name="products[{{ $index }}][quantity]"
                                                        class="form-control text-center" min="1" step="1"
                                                        value="{{ $product['quantity'] }}" placeholder="Jumlah">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="increaseQuantity({{ $index }})">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" formaction="{{ route('removeProduct', $index) }}"
                                                    class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" formaction="{{ route('instant-addProduct') }}"
                                        class="btn btn-primary mb-3">Tambah Produk</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            function increaseQuantity(index) {
                                var quantityInput = document.getElementById('quantity-' + index);
                                quantityInput.value = parseInt(quantityInput.value) + 1;
                            }

                            function decreaseQuantity(index) {
                                var quantityInput = document.getElementById('quantity-' + index);
                                if (quantityInput.value > 1) {
                                    quantityInput.value = parseInt(quantityInput.value) - 1;
                                }
                            }
                        </script>

                        <div class="col col-md-12 mb-3 p-2">
                            <div class="card">
                                <div class="card-body shadow">
                                    <h4>Detail Pengiriman</h4>
                                    <div class="form-group">
                                        <label for="payment">Metode Pembayaran</label>
                                        <select class="form-control" id="payment" name="shipping_detail[payment]">
                                            <option value="">Pilih Metode Pembayaran</option>
                                            <option value="COD"
                                                {{ session('shipping_detail.payment') == 'COD' ? 'selected' : '' }}>COD
                                            </option>
                                            <option value="LUNAS"
                                                {{ session('shipping_detail.payment') == 'LUNAS' ? 'selected' : '' }}>
                                                LUNAS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="berat">Berat (kg)</label>
                                        <input type="number" id="berat" name="shipping_detail[berat]"
                                            class="form-control" step="0.01"
                                            value="{{ session('shipping_detail.berat') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran</label>
                                        <input type="number" id="total_pembayaran"
                                            name="shipping_detail[payment_total]" class="form-control" step="0.01"
                                            value="{{ session('shipping_detail.payment_total') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">

                        <div class="col col-md-12 mb-3 p-2">
                            <div class="card">
                                <div class="card-body shadow">
                                    <h4>Informasi Penerima</h4>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Penerima</label>
                                                <input type="text" id="nama" name="penerima[nama]"
                                                    class="form-control" value="{{ session('penerima.nama') }}">
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="nomor_hp">Nomor HP</label>
                                                <input type="text" id="nomor_hp" name="penerima[nomor_hp]"
                                                    class="form-control" value="{{ session('penerima.nomor_hp') }}">
                                            </div>
                                        </div>
                                        <div class="col col-md-12">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea id="alamat" name="penerima[alamat]" class="form-control" rows="3">{{ session('penerima.alamat') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <select id="provinsi" name="penerima[provinsiId]"
                                                    class="form-control" onchange="loadKabupaten(this.value)">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($provinces as $prov)
                                                        <option value="{{ $prov['id'] }}"
                                                            {{ session('penerima.provinsiId') == $prov['id'] ? 'selected' : '' }}>
                                                            {{ $prov['provinsi'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten</label>
                                                <select id="kabupaten" name="penerima[kabupatenId]"
                                                    class="form-control" onchange="loadKecamatan(this.value)">
                                                    <option value="">Pilih Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select id="kecamatan" name="penerima[kecamatanId]"
                                                    class="form-control">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label for="kelurahan">Kelurahan</label>
                                                <input type="text" id="kelurahan" name="penerima[kelurahan]"
                                                    class="form-control" value="{{ session('penerima.kelurahan') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Koordinat -->
                                    <div class="card" style="border-radius: 15px;">
                                        <div class="card-body">
                                            <h6>Pilih Lokasi</h6>
                                            <div id="map" style="border-radius: 10px;"></div>
                                            <input type="hidden" id="long" name="penerima[koordinat][long]"
                                                value="{{ session('penerima.koordinat.long') }}">
                                            <input type="hidden" id="lat" name="penerima[koordinat][lat]"
                                                value="{{ session('penerima.koordinat.lat') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            @csrf
            <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">Kirim</button>
        </form>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var latitude = {{ session('penerima.koordinat.lat', -7.353083395388788) }};
            var longitude = {{ session('penerima.koordinat.long', 108.22390578662055) }};
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

            loadKabupaten({{ session('penerima.provinsiId') }});
            loadKecamatan({{ session('penerima.kabupatenId') }});
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
