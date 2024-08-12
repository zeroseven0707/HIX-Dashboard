  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
    <div class="container py-5">
        <div class="row">
            <!-- Merchant Info -->
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h2 class="card-title">Merchant: {{ $merchant['bussinesName'] ?? 'N/A' }}</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead">Total Pemasukan: <span class="text-success">{{ number_format($totalPemasukan, 2) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Branch Info -->
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h2 class="card-title">Branch Information</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PIC</th>
                                    <th>Total Paket</th>
                                    <th>Pemasukan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branchs as $branch)
                                <tr>
                                    <td>{{ $branch['branch']['id'] }}</td>
                                    <td>{{ $branch['branch']['pic'] }}</td>
                                    <td>{{ $branch['total_paket'] }}</td>
                                    <td>{{ number_format($branch['pemasukan'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
