<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div>
            <a class="btn btn-primary" href="{{ url('create-sameday') }}" role="button">New Request</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No Resi</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Penerima</th>
                        <th>Status</th>
                        <th>Ongkir</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages['data'] as $package)
                        <tr>
                            <td>{{ $package['noResi'] }}</td>
                            <td>{{ $package['namaPenerima'] }}</td>
                            <td>{{ $package['alamatPenerima'] }}</td>
                            <td>{{ $package['status'] }}</td>
                            <td>Rp {{ number_format($package['ongkir'], 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ url('/merchant/paket-detail'.'/'. $package['noResi']) }}">
                                    <button class="btn btn-info btn-sm">View Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

