<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container py-5">
            <div class="row">
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
                    <button class="btn btn-success w-100" wire:click="exportPdf"><i class="fas fa-file-pdf"></i> Export
                        PDF</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-light">
                            <h5 class="">Finance Report for Merchants</h5>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Business Name</th>
                                            <th>Total Paket</th>
                                            <th>Pendapatan</th>
                                            <th>Cashback</th>
                                            <th>Pendapatan Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($merchants as $merchant)
                                            <tr>
                                                <td>{{ $merchant['merchant']['id'] }}</td>
                                                <td>{{ $merchant['merchant']['bussinesName'] }}</td>
                                                <td>{{ $merchant['total_paket'] }}</td>
                                                <td>Rp. {{ number_format($merchant['pendapatan'], 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($merchant['cashback'], 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($merchant['pendapatanTotal'], 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if (
                                                        !empty($merchant['total_paket']) ||
                                                            !empty($merchant['pendapatan']) ||
                                                            !empty($merchant['cashback']) ||
                                                            !empty($merchant['pendapatanTotal']))
                                                        <span class="badge bg-success">{{ $merchant['status'] }}</span>
                                                    @else
                                                        <span class="badge bg-danger">No Transaksi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ url('/finance-merchant-detail' . '/' . $merchant['merchant']['id']) }}">
                                                        <button class="btn btn-primary">View Detail</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div
                            class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
                            <h6 class="card-title text-center mb-0">Total Uang Keseluruhan</h6>
                            <i class="fas fa-money-bill-wave "></i>
                        </div>
                        <div class="card-body">
                            <h4 class="">Rp. {{ number_format($totalUangSemuaMerchant, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
