<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="row">
                <div class="row mb-4">
                    <div class="col-3">
                        <label for="range" class="form-label">Filter by Range</label>
                        <select wire:model="range" id="range" class="form-select" wire:change="resetDates">
                            <option value="today">Today</option>
                            <option value="last7days">Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                            <!-- Add more ranges as needed -->
                        </select>
                    </div>
                    <div class="col-3 mt-2">
                        <label for="startDate">Start</label>
                        <input type="date" class="form-control" wire:model="startDate" id="startDate">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="endDate">End</label>
                        <input type="date" class="form-control" wire:model="endDate" id="endDate">
                    </div>
                    <div class="col-1 d-flex align-items-end">
                        <button class="btn btn-primary w-100" wire:click="filter">Filter</button>
                    </div>
                    <div class="col-2 d-flex align-items-end">
                        <button class="btn btn-success w-100" wire:click="exportPdf"><i class="fas fa-file-pdf"></i> Export PDF</button>
                    </div>
                </div>

                <!-- Cards for Summary Data -->
                <div class="col-md-3 mt-4">
                    <div class="card text-white bg-success mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Pendapatan Kotor</span>
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($pendapatanKotor, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mt-4">
                    <div class="card text-white bg-info mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Total Cashback</span>
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($totalCashback, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mt-4">
                    <div class="card text-white bg-warning mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Komisi Driver</span>
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($totalkomisiDriver, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mt-4">
                    <div class="card text-white bg-primary mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Pendapatan Bersih</span>
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Paket COD</span>
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($TotalPaketCOD, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Paket Lunas</span>
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($totalPaketLUNAS, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Total Shippings</span>
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalShippings }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Drivers List -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div
                            class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <span>Details</span>
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-body">
                            @if (count($drivers) > 0)
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Driver</th>
                                            <th>Total Paket</th>
                                            <th>Total Setoran</th>
                                            <th>Komisi Driver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($drivers as $driver)
                                            <tr>
                                                <td>{{ $driver['driverName'] }}</td>
                                                <td>{{ $driver['totalPaket'] }}</td>
                                                <td>Rp. {{ number_format($driver['totalSetoran'], 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($driver['komisiDriver'], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
