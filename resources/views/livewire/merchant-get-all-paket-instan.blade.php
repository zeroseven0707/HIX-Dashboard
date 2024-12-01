<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div>
            <div class="d-flex justify-content-between">
                <!-- Filter Status -->
                <div class="">
                    <form wire:submit.prevent="filterByStatus">
                        <div class="input-group">
                            <select wire:model="selectedStatus" class="form-select">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i>Filter</button>
                        </div>
                    </form>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ url('create-instant') }}" role="button">New Request</a>
                </div>
                
            </div>
            
            <div class="card shadow mt-3">
                <div class="card-body">
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
                            @if (!empty($packages))
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package['noResi'] }}</td>
                                    <td>{{ $package['namaPenerima'] }}</td>
                                    <td class="alamat-column">{{ $package['alamatPenerima'] }}</td>
                                    <td>
                                        <span class="badge text-bg-info text-light">{{ $package['status'] }}</span>
                                    </td>
                                    <td>Rp {{ number_format($package['ongkir'], 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ url('/merchant/paket-detail'.'/'. $package['noResi']) }}">
                                            <button class="btn btn-primary btn-sm">View Detail</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No Data Available</td>
                                    </tr>    
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
