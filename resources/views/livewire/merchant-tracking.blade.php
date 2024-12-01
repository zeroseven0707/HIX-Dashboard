<div class="page-content-wrapper">
    <div class="page-content">
        <style>
            body {
                background-color: #f8f9fa;
                font-family: 'Arial', sans-serif;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }

            .card {
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 1rem;
                border: none;
            }

            .card-header {
                color: white;
                padding: 1rem;
                border-radius: 8px 8px 0 0;
            }

            .card-body {
                padding: 2rem;
            }

            .merchant-logo {
                width: 100%;
                max-width: 100px;
                height: auto;
                object-fit: cover;
            }

            .form-group {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .form-control {
                border-radius: 6px;
                padding: 0.75rem;
                border: 1px solid #ced4da;
                width: 100%;
            }

            .btn-custom {
                background-color: #007bff;
                color: white;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                border-radius: 6px;
                transition: background-color 0.3s ease;
            }

            .btn-custom:hover {
                background-color: #0056b3;
            }

            .list-group-item {
                border: none;
                padding-left: 0;
                font-size: 0.95rem;
                padding: 0.5rem 0;
            }

            .list-group-item::before {
                content: "•";
                color: #007bff;
                display: inline-block;
                width: 1em;
                margin-left: -1em;
                font-weight: bold;
            }

            .alert-warning {
                background-color: #fff3cd;
                border-color: #ffeeba;
                color: #856404;
            }

            .badge {
                padding: 0.5em 0.75em;
                font-size: 0.9em;
                border-radius: 0.5rem;
            }

            .badge-warning {
                background-color: #ffc107;
                color: white;
            }

            .badge-success {
                background-color: #28a745;
                color: white;
            }

            .badge-secondary {
                background-color: #6c757d;
                color: white;
            }

            .badge-primary {
                background-color: #007bff;
                color: white;
            }
        </style>

        <!-- Form Input Resi -->
        <form wire:submit.prevent="trackOrder" class="container">
            <label for="resi" class="mb-2">Nomor Resi:</label>
            <div class="form-group">
                <input type="text" id="resi" wire:model="resi" class="form-control w-75"
                    placeholder="Masukkan nomor resi" required>
                <button type="submit" class="btn btn-primary w-40">Track Order</button>
            </div>
        </form>

        <!-- Tracking Information -->
        <div class="container mt-3">
            @if ($driver || $status)
                <div class="card">
                    <div class="card-header bg-primary">
                        <h6 class="card-title"><i class="fas fa-shipping-fast"></i> Tracking Result</h6>
                    </div>
                    <div class="card-body">
                        <!-- Merchant Information -->
                        <div class="row mb-4">
                            <div class="col-md-2">
                                <img src="{{ env('API_BASE_URL_ORIGIN') . $pengirim['logo'] }}" class="merchant-logo"
                                    alt="Merchant Logo">
                            </div>
                            <div class="col-md-10">
                                <h5>
                                    <i class="fas fa-store-alt"></i>
                                    <strong>{{ $pengirim['merchant'] }}</strong>
                                    <small class="text-muted">({{ $pengirim['cabang'] }})</small>
                                </h5>
                                <p class="text-secondary"><small class="text-muted">{{ $pengirim['alamat'] }}</small></p>
                            </div>
                        </div>
                        <hr>

                        <!-- Recipient Information -->
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="card">
                                    <div class="card-body"> --}}
                                        <h6><strong>{{ $penerima['nama'] }}</strong></h6>
                                        <p class="text-secondary"><small class="text-muted">{{ $penerima['alamat'] }}</small></p>
                                    {{-- </div>
                                </div> --}}
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="card"> --}}
                                    {{-- <div class="card-body"> --}}
                                        <p class="card-text">
                                            <i class="fas fa-user-tie"></i>
                                            <strong>Driver:</strong> {{ $driver }}
                                        </p>
                                        <p class="card-text">
                                            <i class="fas fa-info-circle"></i>
                                            <strong>Status:</strong>
                                            <span
                                                class="badge 
                                                @if ($status == 'on Pickup') badge-warning 
                                                @elseif($status == 'on Delivery') badge-success 
                                                @elseif($status == 'Pending') badge-secondary 
                                                @else badge-primary @endif">
                                                {{ $status }}
                                            </span>
                                        </p>
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </div>
                            <div class="col col-md-12">
                                <hr>

                                {{-- <div class="card"> --}}
                                    {{-- <div class="card-body"> --}}
                                        <!-- Log Timeline -->
                                        <h6 class="mt-2"><i class="fas fa-history"></i> Logs</h6>
                                        <ul class="list-group timeline2">
                                            @foreach ($logs as $log)
                                                <li class="list-group-item">
                                                    <span class="text-muted">{{ $log['tanggal'] }}
                                                        {{ date('H:i', strtotime($log['jam'])) }}</span> -
                                                    {{ $log['keterangan'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    No tracking information available.
                </div>
            @endif
        </div>
    </div>
</div>
