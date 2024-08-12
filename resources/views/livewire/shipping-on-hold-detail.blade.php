<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary">Detail Shipping On Hold</h2>
                <button wire:click="onHoldPickup" class="btn btn-success btn-lg">On Hold Pickup</button>
            </div>

            @if(!empty($details))
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <h4 class="card-title text-info">Merchant: {{ $details['merchant'] ?? '' }}</h4>
                        <h5>Branch</h5>
                        <p><strong>Address:</strong> {{ $details['branch']['alamat'] ?? '' }}</p>
                        <p><strong>PIC:</strong> {{ $details['branch']['pic'] ?? '' }}</p>
                        <p><strong>Contact:</strong> {{ $details['branch']['contact'] ?? '' }}</p>
                    </div>
                </div>

                @foreach($details['paket'] ?? [] as $index => $paket)
                    <div class="card mb-4 border-left-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">
                                <a class="text-decoration-none text-dark" data-toggle="collapse" href="#paket-{{ $index }}" role="button" aria-expanded="false" aria-controls="paket-{{ $index }}">
                                    No Resi: {{ $paket['noResi'] }}
                                </a>
                            </h5>
                            <div class="collapse" id="paket-{{ $index }}">
                                <div class="mb-2">
                                    <span class="badge badge-info">{{ $paket['status'] }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama Penerima:</strong> {{ $paket['namaPenerima'] }}</p>
                                        <p><strong>Alamat Penerima:</strong> {{ $paket['alamatPenerima'] }}</p>
                                        <p><strong>Contact Penerima:</strong> {{ $paket['contactPenerima'] }}</p>
                                        <p><strong>Total Checkout:</strong> {{ number_format($paket['totalCheckout'], 2, ',', '.') }}</p>
                                        <p><strong>Payment Status:</strong> {{ $paket['paymentStatus'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Products</h6>
                                        <ul class="list-group mb-3">
                                            @foreach($paket['products'] as $product)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $product['product'] }} 
                                                    <span class="badge badge-primary badge-pill">Quantity: {{ $product['quantity'] }}</span>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <h6>Logs</h6>
                                        <ul class="list-group">
                                            @foreach($paket['logs'] as $log)
                                                <li class="list-group-item">{{ $log['tanggal'] }} {{ $log['jam'] }} - {{ $log['keterangan'] }}</li>
                                            @endforeach
                                        </ul>
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

<!-- Add Bootstrap JS and dependencies if not already included -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
