<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary">Detail Shipping Request</h2>
                <button wire:click="requestPickup" class="btn btn-success btn-lg">Request Pickup</button>
            </div>

            @if(!empty($details))
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <h4 class="card-title text-info">Merchant: {{ $details['merchant']['bussinesName'] }}</h4>
                        <h5>Branch</h5>
                        <p><strong>Address:</strong> {{ $details['branch']['alamat'] }}</p>
                        <p><strong>PIC:</strong> {{ $details['branch']['pic'] }}</p>
                        <p><strong>Contact:</strong> {{ $details['branch']['contact'] }}</p>
                        <p><strong>Kecamatan:</strong> {{ $details['branch']['Kecamatan']['kecamatan'] }}</p>
                    </div>
                </div>

                @foreach($details['paket'] as $index => $paket)
                    <div class="card mb-4 border-left-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">
                                <a class="text-decoration-none text-dark" data-toggle="collapse" href="#paket-{{ $index }}" role="button" aria-expanded="false" aria-controls="paket-{{ $index }}">
                                    {{ $paket['noResi'] }}<br>
                                    <small>penerima : {{ $paket['namaPenerima'] }}</small>
                                </a>
                            </h5>
                            <div class="collapse" id="paket-{{ $index }}">
                                <div class="mb-2">
                                    <span class="badge badge-info">{{ $paket['tanggalRequest'] }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Alamat Penerima:</strong> {{ $paket['alamatPenerima'] }}</p>
                                        <p><strong>Kelurahan Penerima:</strong> {{ $paket['kelurahanPenerima'] }}</p>
                                        <p><strong>Kecamatan:</strong> {{ $paket['Kecamatan']['kecamatan'] }}</p>
                                        <p><strong>Kabupaten:</strong> {{ $paket['Kabupaten']['kabupaten'] }}</p>
                                        <p><strong>Provinsi:</strong> {{ $paket['Provinsi']['provinsi'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">No details available.</p>
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
