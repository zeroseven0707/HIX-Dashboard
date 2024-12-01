<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <h2>Dashboard</h2>
        <!-- Filter by Range -->
        <div class="col-md-4 mb-3 d-flex justify-content-start">
            <div class="w-100">
                <div class="input-group">
                    <select wire:model="range" id="range" class="form-select">
                        <option value="today">Today</option>
                        <option value="last7days">Last 7 Days</option>
                        <option value="last30days">Last 30 Days</option>
                        <!-- Add more ranges as needed -->
                    </select>
                    <button wire:click="fetchData" class="btn btn-primary"><i class="fas fa-search"></i>Filter</button>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- Branch Info -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header ">
                        <h5 class="card-title mb-0"><i class="fas fa-sitemap"></i> Branch Information</h5>
                    </div> 
                    <div class="card-body text-center">
                        <table class="table table-hover table-striped">
                            <thead class="table-secondary">
                                <tr>
                                    <th>PIC</th>
                                    <th>Total Paket</th>
                                    <th>Pemasukan Sudah di Transfer</th>
                                    <th>Pemasukan Belum di Transfer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branchs as $branch)
                                    <tr>
                                        <td>{{ $branch['branch']['pic'] }}</td>
                                        <td>{{ $branch['total_paket'] }}</td>
                                        <td>
                                            <span class="badge bg-success">Rp.
                                                {{ number_format($branch['transferred']['transferred'], 0, ',', '.') }}</span>
                                            <br>
                                            <small class="text-muted"><strong>Cashback: Rp.
                                                    {{ number_format($branch['transferred']['cashbackTransferred'], 0, ',', '.') }}</strong></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger">Rp.
                                                {{ number_format($branch['notTransferred']['notTransferred'], 0, ',', '.') }}</span>
                                            <br>
                                            <small class="text-muted"><strong>Cashback: Rp.
                                                    {{ number_format($branch['notTransferred']['cashbackNotTransferred'], 0, ',', '.') }}</strong></small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted">Updated {{ now()->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>

            <!-- Merchant Info -->
            <div class="col-md-4 mb-3">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="card shadow">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-money-check-alt fa-3x text-success"></i>
                                    <!-- Ikon Pemasukan Transferred -->
                                </div>
                                <div class="text-center flex-grow-1">
                                    <h6 class="text-muted mb-1"><strong>Total Pemasukan Sudah di Transfer</strong>
                                    </h6>
                                    <h4 class="text-success">Rp.
                                        {{ number_format($totalPemasukan['transferred'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-md-12 mt-3">
                        <div class="card shadow">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                                    <!-- Ikon Pemasukan Not Transferred -->
                                </div>
                                <div class="text-center flex-grow-1">
                                    <h6 class="text-muted mb-1"><strong>Total Pemasukan Belum di Transfer</strong>
                                    </h6>
                                    <h4 class="text-danger">Rp.
                                        {{ number_format($totalPemasukan['notTransferred'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('swal', (event) => {
            const data = event
            swal.fire({
                icon: data[0]['icon'],
                title: data[0]['title'],
                text: data[0]['text']
            })
        })
    })
</script>
