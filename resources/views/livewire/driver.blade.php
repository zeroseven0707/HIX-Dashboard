  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <a href="/driver-registration">
            <button class="btn btn-primary">New</button>
        </a>
    <table class="table align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>Full Name</th>
                <th>Unit Kendaraan</th>
                <th>Contact</th>
                <th>Keterangan</th>
                <th colspan="2">Verif Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($driver as $item)
                <tr>
                    <td>{{ $item['fullName'] }}</td>
                    <td>{{ $item['UnitKendaraan']['unitKendaraan'] }}</td>
                    <td>{{ $item['contact'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                    <td>{{ $item['verifStatus'] }}</td>
                    <td>
                        <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['id'] }}')">View Detail</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="modal fade @if($showDetailModal) show @endif" tabindex="-1" role="dialog" style="@if($showDetailModal) display: block; @else display: none; @endif">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Shipping Details</h5>
                    <button type="button" class="btn btn-close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($driverDetail)
                        <div class="container">
                            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                <div class="card-header text-center">
                                    <h4 class="card-title">{{ $driverDetail['fullName'] }}</h4>
                                    <p class="card-subtitle text-muted">{{ $driverDetail['contact'] }}</p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        {{-- <li class="list-group-item">
                                            <strong>Driver ID:</strong> {{ $driverDetail['id'] }}
                                        </li> --}}
                                        <li class="list-group-item">
                                            <strong>Contact:</strong> {{ $driverDetail['contact'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Status:</strong> {{ $driverDetail['keterangan'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Verification Status:</strong> {{ $driverDetail['verifStatus'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Kecamatan:</strong> {{ $driverDetail['Kecamatan']['kecamatan'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Provinsi:</strong> {{ $driverDetail['Provinsi']['provinsi'] }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Kabupaten:</strong> 
                                            @if($driverDetail['Kabupaten'])
                                                {{ $driverDetail['Kabupaten']['kabupaten'] }}
                                            @else
                                                Tidak tersedia
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="mt-3">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p><strong>Foto KTP:</strong></p>
                                                <img src="{{ asset('https://tedy-dev.my.id/'.$driverDetail['ktp']) }}" alt="KTP" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    @if ($driverDetail['verifStatus'] == 'UnActive')
                                    <form  wire:submit.prevent="verif('{{ $driverDetail['id'] }}')">
                                        <button class='btn btn-danger float-end'>Verifikasi</button>
                                    </form>
                                    @else
                                        <button class='btn btn-primary float-end'>Accepted</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No details available.</p>
                    @endif
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                </div>
            </div>
        </div>
      </div>
</div>
</div>