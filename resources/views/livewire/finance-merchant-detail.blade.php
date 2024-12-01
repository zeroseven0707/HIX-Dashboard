<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <h4 class="mb-4" style="color: #343a40;">Detail Laporan Merchant</h4>
            <div class="row justify-content-center">
                @if ($details)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card mb-2 border-info shadow-sm">
                                    <div class="card-header bg-info text-white text-center p-2">
                                        <h6 class="mb-0" style="font-size: 0.85rem;"><i class="fas fa-boxes"></i>
                                            Total Paket</h6>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <div class="mb-1">
                                            <i class="fas fa-box fa-2x text-info"></i>
                                        </div>
                                        <h6 class="font-weight-bold" style="font-size: 1rem;">
                                            {{ $details['totalPackages'] ?? '0' }}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mb-2 border-info shadow-sm">
                                    <div class="card-header bg-info text-white text-center p-2">
                                        <h6 class="mb-0" style="font-size: 0.85rem;"><i class="fas fa-wallet"></i>
                                            Total Pendapatan</h6>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <div class="mb-1">
                                            <i class="fas fa-wallet fa-2x text-info"></i>
                                        </div>
                                        <h6 class="font-weight-bold" style="font-size: 1rem;">Rp.
                                            {{ number_format($details['totalIncome'], 0, ',', '.') ?? '0' }}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mb-2 border-info shadow-sm">
                                    <div class="card-header bg-info text-white text-center p-2">
                                        <h6 class="mb-0" style="font-size: 0.85rem;"><i
                                                class="fas fa-hand-holding-usd"></i> Total Cashback</h6>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <div class="mb-1">
                                            <i class="fas fa-hand-holding-usd fa-2x text-info"></i>
                                        </div>
                                        <h6 class="font-weight-bold" style="font-size: 1rem;">Rp.
                                            {{ number_format($details['totalCashback'], 0, ',', '.') ?? '0' }}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mb-2 border-info shadow-sm">
                                    <div class="card-header bg-info text-white text-center p-2">
                                        <h6 class="mb-0" style="font-size: 0.85rem;"><i class="fas fa-tags"></i>
                                            Total Keseluruhan</h6>
                                    </div>
                                    <div class="card-body text-center p-2">
                                        <div class="mb-1">
                                            <i class="fas fa-tags fa-2x text-info"></i>
                                        </div>
                                        <h6 class="font-weight-bold" style="font-size: 1rem;">Rp.
                                            {{ number_format($details['totalOverall'], 0, ',', '.') ?? '0' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi Merchant, Rekening, dan Upload Bukti Transfer dalam satu card -->
                    <div class="col-md-12">
                        <div class="card mb-2 border-primary shadow-sm">
                            <div class="card-body">
                                {{-- <h5 class="text-center"
                                    style="font-size: 1rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                                    <i class="fas fa-store"></i> Informasi Merchant, Rekening & Bukti
                                    Transfer
                                </h5> --}}
                                <div class="row">
                                    <!-- Informasi Merchant -->
                                    <div class="col-md-6">
                                        <h6 style="font-size: 0.85rem;"><i class="fas fa-store"></i>
                                            Informasi Merchant</h6>
                                        <div class="row align-items-center">
                                            <div class="col-md-4 text-center">
                                                <img src="{{ env('API_BASE_URL_ORIGIN') . $details['merchant']['logo'] }}"
                                                    alt="Logo Merchant" class="img-fluid rounded-circle mb-2 shadow-sm"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <h6 class="text-primary mt-1"
                                                    style="font-size: 1rem; font-weight: bold;">
                                                    {{ $details['merchant']['bussinesName'] }}
                                                </h6>
                                            </div>
                                            <div class="col-md-8">
                                                <p style="font-size: 0.85rem; line-height: 1.3;">
                                                    <strong>Nama Pemilik:</strong>
                                                    {{ $details['merchant']['bussinesOwener'] }}
                                                </p>
                                                <p style="font-size: 0.85rem; line-height: 1.3;">
                                                    <strong>Nomor HP:</strong> <i class="fas fa-phone-alt"></i>
                                                    {{ $details['merchant']['nomorHp'] }}
                                                </p>
                                                <p style="font-size: 0.85rem; line-height: 1.3;">
                                                    <strong>Jenis Usaha:</strong>
                                                    {{ $details['merchant']['JenisUsaha']['jenisUsaha'] }}
                                                    ({{ $details['merchant']['JenisUsaha']['singkatan'] }})
                                                </p>
                                                <p style="font-size: 0.85rem; line-height: 1.3;">
                                                    <strong>Kategori Usaha:</strong>
                                                    {{ $details['merchant']['KategoriUsaha']['kategori'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Rekening -->
                                    <div class="col-md-4">

                                        <h6 style="font-size: 0.85rem;"><i class="fas fa-money-check-alt"></i>
                                            Informasi Rekening</h6>
                                        <div class="ms-4">
                                            <p style="font-size: 0.9rem;"><strong>Bank:</strong>
                                                {{ $details['rekening']['bank'] }}</p>
                                            <p style="font-size: 0.9rem;"><strong>No. Rekening:</strong>
                                                {{ $details['rekening']['noRekening'] }}</p>
                                            <p style="font-size: 0.9rem;"><strong>Atas Nama:</strong>
                                                {{ $details['rekening']['nama'] }}</p>
                                            <p style="font-size: 0.9rem;"><strong>Status:</strong>
                                                <span
                                                    class="{{ $details['rekening']['active'] ? 'text-success' : 'text-danger' }}">
                                                    <i
                                                        class="{{ $details['rekening']['active'] ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                                                    {{ $details['rekening']['active'] ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <!-- Form Upload Bukti Transfer -->
                                <div class="mt-3">
                                    <form wire:submit.prevent="uploadBuktiTransfer" enctype="multipart/form-data">
                                        <input type="hidden" wire:model="idmerchant">
                                        <!-- Hidden input for merchant ID -->
                                        <div class="form-group">
                                            <label for="buktiTransfer" style="font-size: 0.9rem;">Upload Bukti
                                                Transfer</label>
                                            <input type="file" class="form-control" id="buktiTransfer"
                                                wire:model="bukti_transfer">
                                        </div>
                                        @error('bukti_transfer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <button type="submit" class="btn btn-primary text-light btn-sm mt-3"><i
                                                class="fas fa-upload"></i> Upload</button>
                                    </form>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success mt-2">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger mt-2">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        No information available.
                    </div>
                @endif
                <!-- Rincian Keuangan di bagian atas -->

                <div class="text-end mb-5">
                    {{-- <button wire:click="exportPdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button> --}}
                    <a href="/finance-merchant" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                
            </div>
            {{-- <div class="card">
                <div class="card-body">
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Include JS for collapse functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
