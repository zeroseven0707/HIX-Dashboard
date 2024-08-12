<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Driver Commissions</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Driver Name</th>
                            <th>Contact</th>
                            <th>Total Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($details as $detail)
                            <tr>
                                <td>{{ $detail['id'] }}</td>
                                <td>{{ $detail['Driver']['fullName'] }}</td>
                                <td>{{ $detail['Driver']['contact'] }}</td>
                                <td>{{ $detail['total'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>