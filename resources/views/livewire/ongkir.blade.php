  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
<div class="container mt-5">
    <h2>Ongkir List</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Merchant</th>
                    <th>Service</th>
                    <th>Unit Kendaraan</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    @foreach($item['ongkir_instant'] as $ongkir)
                        <tr>
                            <td>{{ $ongkir['id'] }}</td>
                            <td>{{ $item['merchant']['bussinesName'] }}</td>
                            <td>{{ $ongkir['Service']['service'] }}</td>
                            <td>{{ $ongkir['UnitKendaraan']['unitKendaraan'] }}</td>
                            <td>{{ $ongkir['cost'] }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="viewDetail({{ $ongkir['id'] }})">View Detail</button>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($item['ongkir_same_day'] as $ongkir)
                        <tr>
                            <td>{{ $ongkir['id'] }}</td>
                            <td>{{ $item['merchant']['bussinesName'] }}</td>
                            <td>{{ $ongkir['Service']['service'] }}</td>
                            <td>{{ $ongkir['UnitKendaraan']['unitKendaraan'] }}</td>
                            <td>{{ $ongkir['cost'] }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="viewDetail({{ $ongkir['id'] }})">View Detail</button>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($details)
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Ongkir</h5>
                        <button type="button" class="btn-close" wire:click="$set('details', null)"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Merchant:</strong> {{ $details['Merchant']['bussinesName'] }}</p>
                        <p><strong>Cost:</strong> {{ $details['cost'] }}</p>
                        <p><strong>Additional Cost:</strong> {{ $details['additionalCost'] }}</p>
                        <form wire:submit.prevent="updateOngkir">
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="cost" wire:model="cost">
                            </div>
                            <div class="mb-3">
                                <label for="additionalCost" class="form-label">Additional Cost</label>
                                <input type="number" class="form-control" id="additionalCost" wire:model="additionalCost">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</div>
</div>