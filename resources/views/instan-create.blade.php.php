<style>
    #map {
        height: 400px;
        border: 1px solid black;
    }
</style>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

<div class="page-content-wrapper">
    <div class="page-content container mt-5">
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

        <form action="{{ route('submit') }}" method="POST">
            @csrf
            <!-- Produk -->
            <div class="mb-4">
                <h4>Produk</h4>
                @foreach (session('products', []) as $index => $product)
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="products[{{ $index }}][product]" class="form-control" value="{{ $product['product'] }}" placeholder="Nama Produk">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="products[{{ $index }}][quantity]" class="form-control" min="1" step="1" value="{{ $product['quantity'] }}" placeholder="Jumlah">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" formaction="{{ route('removeProduct', $index) }}" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                @endforeach
                <button type="submit" formaction="{{ route('addProduct') }}" class="btn btn-primary">Tambah Produk</button>
            </div>

            <!-- Shipping Detail -->
            <div class="mb-4">
                <h4>Detail Pengiriman</h4>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="shipping_detail[payment]" class="form-select">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="COD" {{ session('shipping_detail.payment') == 'COD' ? 'selected' : '' }}>COD</option>
                        <option value="LUNAS" {{ session('shipping_detail.payment') == 'LUNAS' ? 'selected' : '' }}>LUNAS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" name="shipping_detail[berat]" class="form-control" step="0.01" value="{{ session('shipping_detail.berat') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Pembayaran</label>
                    <input type="number" name="shipping_detail[payment_total]" class="form-control" step="0.01" value="{{ session('shipping_detail.payment_total') }}">
                </div>
            </div>

            <!-- Penerima -->
            <div class="mb-4">
                <h4>Informasi Penerima</h4>
                <div class="mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" name="penerima[nama]" class="form-control" value="{{ session('penerima.nama') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="penerima[alamat]" class="form-control" value="{{ session('penerima.alamat') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="penerima[nomor_hp]" class="form-control" value="{{ session('penerima.nomor_hp') }}">
                </div>
                
                <div class="mb-3">
                    <label for="provinsi">Provinsi</label>
                    <select id="provinsi" name="penerima[provinsiId]" class="form-control" onchange="loadKabupaten(this.value)">
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov['id'] }}" {{ session('penerima.provinsiId') == $prov['id'] ? 'selected' : '' }}>{{ $prov['provinsi'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kabupaten">Kabupaten</label>
                    <select id="kabupaten" name="penerima[kabupatenId]" class="form-control" onchange="loadKecamatan(this.value)">
                        <option value="">Pilih Kabupaten</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kecamatan">Kecamatan</label>
                    <select id="kecamatan" name="penerima[kecamatanId]" class="form-control">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelurahan</label>
                    <input type="text" name="penerima[kelurahan]" class="form-control" value="{{ session('penerima.kelurahan') }}">
                </div>

                <!-- Koordinat -->
                <div id="map"></div>
                <input type="hidden" id="long" name="penerima[koordinat][long]" value="{{ session('penerima.koordinat.long') }}">
                <input type="hidden" id="lat" name="penerima[koordinat][lat]" value="{{ session('penerima.koordinat.lat') }}">
            </div>

            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
        fetch(`/sameday-create-shipping/kabupaten?provinsiId=${provinsiId}`)
            .then(response => response.json())
            .then(data => {
                let kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(kab => {
                    kabupatenSelect.innerHTML += `<option value="${kab.id}">${kab.kabupaten}</option>`;
                });

                loadKecamatan(document.getElementById('kabupaten').value);
            });
    }

    function loadKecamatan(kabupatenId) {
        fetch(`/sameday-create-shipping/kecamatan?kabupatenId=${kabupatenId}`)
            .then(response => response.json())
            .then(data => {
                let kecamatanSelect = document.getElementById('kecamatan');
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                data.forEach(kec => {
                    kecamatanSelect.innerHTML += `<option value="${kec.id}">${kec.kecamatan}</option>`;
                });
            });
    }
</script>

