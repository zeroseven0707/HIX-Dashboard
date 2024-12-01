<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <!-- Header with Back Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary"><i class="fas fa-shipping-fast"></i> Detail Shipping On Delivery</h4>
                <button wire:click="back" class="btn btn-outline-primary btn-sm mt-3">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Kecamatan Detail -->
            @if (!empty($details['kecamatan'] || !empty($details['meta'])))
                <div class="mb-3 text-muted">
                    <span class="badge text-bg-secondary text-uppercase"
                        style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                        <i class="fas fa-map-marker-alt"></i> Kecamatan: {{ $details['kecamatan'] }}
                    </span>
                    <span class="badge text-bg-warning text-light text-uppercase"
                        style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                        <i class="fas fa-box"></i> Total Paket: {{ $details['meta']['total'] }}
                    </span>
                </div>
            @endif

            <!-- Package Loop -->
            <div class="row">
                @foreach ($details['paket'] as $index => $package)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow border-left-primary rounded-lg">
                            <div class="card-header bg-primary text-light" data-toggle="collapse"
                                href="#package-{{ $index }}" role="button" aria-expanded="false"
                                aria-controls="package-{{ $index }}">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <span class="text-decoration-none">
                                        <i class="fas fa-box-open"></i> {{ $package['noResi'] }}
                                        <i class="ml-2 fas fa-caret-down"></i>
                                    </span>
                                    <small class="text-light"><i class="fas fa-user"></i>
                                        {{ $package['namaPenerima'] }}</small>
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Collapse Section -->
                                <div class="collapse" id="package-{{ $index }}">
                                    <!-- Status Badge -->
                                    <div class="mb-2 d-flex justify-content-end">
                                        <span class="badge text-bg-warning text-light">
                                            <i class="fas fa-info-circle"></i> {{ $package['status'] }}
                                        </span>
                                    </div>

                                    <!-- Package Info -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6><i class="fas fa-user"></i> Informasi Penerima</h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="compact-text">
                                                            <strong>{{ $package['namaPenerima'] }}</strong></p>
                                                        <p class="compact-text">{{ $package['contactPenerima'] }}</p>
                                                    </div>
                                                    <p class="compact-text">{{ $package['alamatPenerima'] }}</p>
                                                    <div class="mt-2">
                                                        <p class="compact-text text-start">
                                                            <button class="btn btn-outline-success btn-sm w-100">
                                                                <i class="fas fa-shopping-cart"></i> Total Checkout Rp.
                                                                {{ number_format($package['totalCheckout'], 2, ',', '.') }}
                                                            </button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product List -->
                                    <h6><i class="fas fa-box"></i> Products</h6>
                                    <ul class="list-group mb-3">
                                        @foreach ($package['products'] as $product)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $product['product'] }}
                                                <span class="badge badge-primary badge-pill">Quantity:
                                                    {{ $product['quantity'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Log Timeline -->
                                    <h6><i class="fas fa-history"></i> Logs</h6>
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group timeline mb-3">
                                                @foreach ($package['logs'] as $log)
                                                    <li class="list-group-item">
                                                        <span class="text-muted">{{ $log['tanggal'] }}
                                                            {{ date('H:i', strtotime($log['jam'])) }}</span> -
                                                        {{ $log['keterangan'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <!-- Pagination -->
            @if (!empty($details['meta']))
                <div class="text-center mt-3">
                    <p>Halaman {{ $details['meta']['page'] }} dari {{ $details['meta']['last_page'] }}</p>
                </div>
            @endif --}}
            <div class="pagination-controls">
                @if ($page > 1)
                    <button wire:click="prevPage" class="btn btn-secondary">Previous</button>
                @endif

                @if ($page < $totalPages)
                    <button wire:click="nextPage" class="btn btn-primary">Next</button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Include JS for collapse functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
