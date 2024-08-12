<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-4">
                    <label for="startDate">Start</label>
                    <input type="date" class="form-control" wire:model="startDate" id="startDate">
                </div>
                <div class="col-4">
                    <label for="endDate">End</label>
                    <input type="date" class="form-control" wire:model="endDate" id="endDate">
                </div>
                <div class="col-4">
                    <button class="btn btn-primary" wire:click="filter">Filter</button>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Pendapatan Kotor</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($pendapatanKotor, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Cashback</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($totalCashback, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Komisi Driver</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($totalkomisiDriver, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Pendapatan Bersih</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Shippings</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalShippings }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Pemasukan Paket COD</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($TotalPaketCOD, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Pemasukan Paket Lunas</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($totalPaketLUNAS, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Drivers
                        </div>
                        <div class="card-body">
                            @if(count($drivers) > 0)
                                <ul class="list-group">
                                    @foreach($drivers as $driver)
                                        <li class="list-group-item">{{ $driver['driverName'] }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No drivers available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content wrapper-->
