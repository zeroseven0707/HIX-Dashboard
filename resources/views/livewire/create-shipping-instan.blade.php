<style>
    #map {
        height: 400px;
        border: 1px solid black;
    }
</style>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
<!-- start page content wrapper -->
<div class="page-content-wrapper">
    <!-- start page content -->
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
        <form wire:submit.prevent="submit">
            <!-- Produk -->
            <div class="mb-4">
                <h4>Produk</h4>
                @foreach ($products as $index => $product)
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4">
                            <input type="text" class="form-control" wire:model="products.{{ $index }}.product" placeholder="Nama Produk">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" wire:model="products.{{ $index }}.quantity" min="1" step="1" placeholder="Jumlah">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger" wire:click="removeProduct({{ $index }})">Hapus</button>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary" wire:click="addProduct">Tambah Produk</button>
            </div>

            <!-- Shipping Detail -->
            <div class="mb-4">
                <h4>Detail Pengiriman</h4>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select class="form-select" wire:model="shipping_detail.payment">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="COD">COD</option>
                        <option value="LUNAS">LUNAS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" class="form-control" step="0.01" wire:model="shipping_detail.berat">
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Pembayaran</label>
                    <input type="number" class="form-control" step="0.01" wire:model="shipping_detail.payment_total">
                </div>
            </div>

            <!-- Penerima -->
            <div class="mb-4">
                <h4>Informasi Penerima</h4>
                <div class="mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" wire:model="penerima.nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" wire:model="penerima.alamat">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" wire:model="penerima.nomor_hp">
                </div>
                
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
                <!-- Kelurahan -->
                <div class="mb-3">
                    <label class="form-label">Kelurahan</label>
                    <input type="text" class="form-control" wire:model="penerima.kelurahan">
                </div>

                <div id="map"></div>
                <!-- Koordinat -->
                    <input type="hidden" id="long" class="form-control" wire:model="penerima.koordinat.long">
                    <input type="hidden" id="lat" class="form-control" wire:model="penerima.koordinat.lat">
            </div>

            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>
    <!-- end page content -->
</div>
<!-- end page content wrapper -->
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
</script>