<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
<div class="container py-5">
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
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h2 class="card-title">Finance Report for Merchants</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Business Name</th>
                                <th>Total Paket</th>
                                <th>Pendapatan</th>
                                <th>Cashback</th>
                                <th>Pendapatan Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merchants as $merchant)
                            <tr>
                                <td>{{ $merchant['merchant']['id'] }}</td>
                                <td>{{ $merchant['merchant']['bussinesName'] }}</td>
                                <td>{{ $merchant['total_paket'] }}</td>
                                <td>{{ number_format($merchant['pendapatan'], 2) }}</td>
                                <td>{{ number_format($merchant['cashback'], 2) }}</td>
                                <td>{{ number_format($merchant['pendapatanTotal'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h2 class="card-title">Total Uang Semua Merchant</h2>
                </div>
                <div class="card-body">
                    <p class="display-4 text-success">{{ number_format($totalUangSemuaMerchant, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
