
<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <style>
            body {
                background-color: #f8f9fa;
            }
            .card {
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                margin-bottom: 1rem;
            }
            .card-header {
                background-color: #007bff;
                color: #fff;
                border-bottom: none;
                border-radius: 8px 8px 0 0;
                padding: 1rem;
            }
            .card-body {
                padding: 2rem;
            }
            .card-title {
                margin-bottom: 0.5rem;
            }
            .card-text {
                margin-bottom: 1rem;
            }
            .list-group-item {
                border: none;
                padding-left: 0;
            }
            .list-group-item::before {
                content: "•";
                color: #007bff;
                display: inline-block;
                width: 1em;
                margin-left: -1em;
            }
            .btn-custom {
                background-color: #007bff;
                color: #fff;
                border: none;
            }
            .btn-custom:hover {
                background-color: #0056b3;
            }
        </style>
    <form wire:submit.prevent="trackOrder">
        <label for="resi">Nomor Resi:</label>
        <div class="form-group d-flex gap-4">
            <input type="text" id="resi" wire:model="resi" class="form-control w-75" required>
            <button type="submit" class="btn btn-primary">Track Order</button>
        </div>
    </form>

    <div class="container mt-5">
        @if ($driver || $status)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tracking Result</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Driver:</strong> {{ $driver }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $status }}</p>
                    </div>
                </div>
                
                @if (count($logs) > 0)
                    <h5 class="card-title mt-4">Logs:</h5>
                    <ul class="list-group">
                        @foreach ($logs as $log)
                            <li class="list-group-item">
                                <strong>{{ $log['tanggal'] }} {{ $log['jam'] }}:</strong> {{ $log['keterangan'] }}
                            </li>
                        @endforeach
                    </ul>
                @endif
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
