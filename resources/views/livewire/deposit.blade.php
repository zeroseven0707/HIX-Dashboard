<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <h3>Daftar Setoran</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                {{-- <div class="d-flex mb-4">
                    <input type="text" wire:model="search" class="form-control me-2" placeholder="Search by Driver Name">
                    <button class="btn btn-primary" wire:click="searchDeposits">Search</button>
                </div> --}}
            </div>
        </div>

        <!-- Menampilkan total deposit hari ini -->
        <div class="alert alert-light text-center" role="alert">
            Total Setoran Hari Ini: <strong>Rp. {{ number_format($totalDepositeHariIni, 0, ',', '.') }}</strong>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Driver</th>
                                <th>Total Deposit Wajib</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->filteredDeposits as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ env('API_BASE_URL_ORIGIN') . $item['foto'] }}"
                                                alt="Foto Driver" class="img-thumbnail me-2"
                                                style="width: 50px; height: 50px;">
                                            <span>{{ $item['fullName'] }}</span>
                                        </div>
                                    </td>
                                    <td>Rp. {{ number_format($item['totalDepositeWajib'], 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-primary"
                                            wire:click="detailDeposit('{{ $item['id'] }}')">View Detail</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
        <div class="modal fade @if ($showDetailModal2) show @endif" tabindex="-1" role="dialog"
            style="@if ($showDetailModal2) display: block; @else display: none; @endif">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-money-check-alt"></i> Detail Setoran
                        </h5>
                        <button type="button" class="btn btn-close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($detail)
                            <div class="container">
                                <div class="card shadow-sm p-3 bg-white rounded">
                                    <div class="card-header text-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1 text-center">
                                                <h5 class="card-title">{{ $detail['fullName'] }}</h5>
                                                <p class="card-subtitle text-muted"><i class="fas fa-phone"></i>
                                                    {{ $detail['contact'] }}</p>
                                            </div>
                                            <div>
                                                <img src="{{ env('API_BASE_URL_ORIGIN') . $item['foto'] }}"
                                                    alt="Profile Photo" class="img-fluid rounded-circle"
                                                    style="width: 50px; height: 50px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item text-center">
                                                <button class="btn btn-outline-success">
                                                    <h5><strong><i class="fas fa-wallet"></i> Total Setoran:</strong>
                                                        {{ $detail['totalDeposite'] }}</h5>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                    <h4 class="text-center">Shipping Detail</h4>
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>ID</th>
                                                    <th>Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Total Checkout</th>
                                                    <th>Ongkir</th>
                                                    <th>Komisi Driver</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($shipping))
                                                    @foreach ($shipping as $ship)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $ship['id'] }}</td>
                                                            <td>{{ $ship['status'] }}</td>
                                                            <td>{{ $ship['paymentStatus'] }}</td>
                                                            <td>Rp.
                                                                {{ number_format($ship['totalCheckout'] ?? 0, 0, ',', '.') }}
                                                            </td>
                                                            <td>Rp.
                                                                {{ number_format($ship['ongkir'] ?? 0, 0, ',', '.') }}
                                                            </td>
                                                            <td>Rp.
                                                                {{ number_format($ship['komisi'] ?? 0, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Shipping Data Available</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center">No details available.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        @if ($detail)
                            <button type="button" class="btn btn-primary"
                                wire:click="updateDeposit({{ $detail['id'] }})">
                                <i class="fas fa-save"></i> Setorkan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
