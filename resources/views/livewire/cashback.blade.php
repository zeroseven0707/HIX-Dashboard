  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cashbacks</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Merchant ID</th>
                                    <th>Business Name</th>
                                    <th>Instant Cashback</th>
                                    <th>SameDay Cashback</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cashbacks as $cashback)
                                    <tr>
                                        <td>{{ $cashback['merchant']['id'] }}</td>
                                        <td>{{ $cashback['merchant']['bussinesName'] }}</td>
                                        <td>
                                            @foreach ($cashback['cashback_instant'] as $instant)
                                                {{ $instant['cashback'] }} ({{ $instant['Service']['service'] }} - {{ $instant['UnitKendaraan']['unitKendaraan'] }})
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($cashback['cashback_same_day'] as $sameDay)
                                                {{ $sameDay['cashback'] }} ({{ $sameDay['Service']['service'] }} - {{ $sameDay['UnitKendaraan']['unitKendaraan'] }})
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-info" wire:click="viewDetail({{ $cashback['cashback_instant'][0]['id'] ?? $cashback['cashback_same_day'][0]['id'] }})">View Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($detail)
                <div class="modal fade show d-block" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cashback Detail</h5>
                                <button type="button" class="close" wire:click="$set('detail', null)">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $detail['id'] }}</p>
                                <p><strong>Cashback:</strong> {{ $detail['cashback'] }}</p>
                                <p><strong>Merchant Name:</strong> {{ $detail['Merchant']['bussinesName'] }}</p>
                                <p><strong>Business Owner:</strong> {{ $detail['Merchant']['bussinesOwener'] }}</p>
                                <p><strong>Category:</strong> {{ $detail['Merchant']['KategoriUsaha']['kategori'] }}</p>
                                <p><strong>Type:</strong> {{ $detail['Merchant']['JenisUsaha']['jenisUsaha'] }} ({{ $detail['Merchant']['JenisUsaha']['singkatan'] }})</p>
                                <div class="form-group">
                                    <label for="cashbackAmount">Update Cashback Amount:</label>
                                    <input type="number" class="form-control" id="cashbackAmount" wire:model="cashbackAmount">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="$set('detail', null)">Close</button>
                                <button type="button" class="btn btn-primary" wire:click="updateCashback">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
            @endif
        </div>
    </div>
</div>
