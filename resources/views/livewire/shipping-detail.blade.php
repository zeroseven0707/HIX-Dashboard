<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary">Detail Shipping Need Assigned</h2>
                <button wire:click="assignDriver" class="btn btn-primary mt-3">Assign Driver</button>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if(!empty($details))
                @if (!empty($details['kecamatan']))
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h4 class="card-title text-info">Kecamatan: {{ $details['kecamatan']['kecamatan'] }}</h4>
                        </div>
                    </div>
                @endif
                @foreach($details['paket'] as $index => $package)
                    <div class="card mb-4 border-left-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">
                                <a class="text-decoration-none text-dark" data-toggle="collapse" href="#package-{{ $index }}" role="button" aria-expanded="false" aria-controls="package-{{ $index }}">
                                    {{ $package['noResi'] }}
                                </a>
                            </h5>
                            <div class="collapse" id="package-{{ $index }}">
                                <div class="mb-2">
                                    <span class="badge badge-info">{{ $package['status'] }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama Penerima:</strong> {{ $package['namaPenerima'] }}</p>
                                        <p><strong>Alamat Penerima:</strong> {{ $package['alamatPenerima'] }}</p>
                                        <p><strong>Kontak Penerima:</strong> {{ $package['contactPenerima'] }}</p>
                                        <p><strong>Total Checkout:</strong> {{ $package['totalCheckout'] }}</p>
                                    </div>
                                </div>

                                <h6 class="mt-3">Products</h6>
                                <ul class="list-group mb-3">
                                    @foreach($package['products'] as $product)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $product['product'] }} 
                                            <span class="badge badge-primary badge-pill">Quantity: {{ $product['quantity'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <h6>Logs</h6>
                                <ul class="list-group">
                                    @foreach($package['logs'] as $log)
                                        <li class="list-group-item">{{ $log['tanggal'] }} {{ $log['jam'] }} - {{ $log['keterangan'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (!empty($details['meta']))
                    <div class="pagination">
                        <p>Halaman {{ $details['meta']['page'] }} dari {{ $details['meta']['last_page'] }}</p>
                        <p>Total Paket: {{ $details['meta']['total'] }}</p>
                    </div>
                @endif
            @else
                <p class="text-muted">No details available.</p>
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
