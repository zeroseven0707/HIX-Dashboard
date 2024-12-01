<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary"><i class="fas fa-box-open"></i> Detail Shipping Request</h4>
                <button wire:click="requestPickup" class="btn btn-outline-success">
                    <i class="fas fa-truck"></i> Request Pickup
                </button>
            </div>

            <!-- If details are available -->
            @if (!empty($details))
                <div class="card mb-4 shadow border-0 rounded-lg">
                    <div class="card-body">
                        <h4 class="card-title text-warning text-center">
                            <i class="fas fa-store"></i> Merchant {{ $details['merchant']['bussinesName'] }}
                        </h4>
                        <div class="border-top pt-3 mt-3">
                            <h5 class="text-muted"><i class="fas fa-map-marker-alt"></i> Branch Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1">
                                        <strong>Address </strong>
                                    </p>
                                    <p class="text-muted">{{ $details['branch']['alamat'] }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1">
                                        <strong>PIC </strong>
                                    </p>
                                    <p class="text-muted">{{ $details['branch']['pic'] }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1">
                                        <strong>Kecamatan</strong>
                                    </p>
                                    <p class="text-muted">{{ $details['branch']['Kecamatan']['kecamatan'] }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="mb-1">
                                        <strong>Contact </strong>
                                    </p>
                                    <p class="text-muted">{{ $details['branch']['contact'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Loop -->
                <div class="row">
                    @foreach ($details['paket'] as $index => $paket)
                        <div class="col col-md-6">
                            <div class="card mb-4 shadow border-0 rounded-lg" data-toggle="collapse"
                                href="#paket-{{ $index }}" role="button" aria-expanded="false"
                                aria-controls="paket-{{ $index }}">
                                <div class="card-header bg-primary">
                                    <h5 class="card-title text-light d-flex justify-content-between align-items-center">
                                        <a class="text-decoration-none text-light">
                                            <i class="fas fa-box"></i> {{ $paket['noResi'] }} <i
                                                class="ml-2 fas fa-caret-down"></i>
                                        </a>
                                        <small class=""><i class="fas fa-user"></i>
                                            {{ $paket['namaPenerima'] }}</small>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- Collapse for details -->
                                    <div class="collapse" id="paket-{{ $index }}">
                                        <!-- Badge Tanggal Request -->
                                        <div class="mb-2 d-flex justify-content-end align-items-end">
                                            <span class="badge text-bg-secondary text-light">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($paket['tanggalRequest'])->format('d F Y') }}
                                            </span>
                                        </div>

                                        <!-- Package Information -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><i class="fas fa-info-circle"></i> Alamat Penerima</h6>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $paket['alamatPenerima'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelurahan</td>
                                                        <td>{{ $paket['kelurahanPenerima'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan</td>
                                                        <td>{{ $paket['Kecamatan']['kecamatan'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kabupaten</td>
                                                        <td>{{ $paket['Kabupaten']['kabupaten'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>
                                                        <td>{{ $paket['Provinsi']['provinsi'] }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="pagination-controls">
                        @if ($page > 1)
                            <button wire:click="prevPage" class="btn btn-secondary">Previous</button>
                        @endif

                        @if ($page < $totalPages)
                            <button wire:click="nextPage" class="btn btn-primary">Next</button>
                        @endif
                    </div> --}}
                </div>
            @else
                <p class="text-muted">No details available.</p>
            @endif
        </div>
    </div>
</div>

<!-- External JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
