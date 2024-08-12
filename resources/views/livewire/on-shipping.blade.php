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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="home" aria-selected="true">New Request</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#hold" type="button" role="tab" aria-controls="hold" aria-selected="true">On Hold</button>
              </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pickup-tab" data-bs-toggle="tab" data-bs-target="#pickup" type="button" role="tab" aria-controls="profile" aria-selected="false">On Pickup</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="contact" aria-selected="false">On Delivery</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab" aria-controls="done" aria-selected="false">Shipping Done</button>
              </li>
        </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Service</th>
                            <th>Payment Status</th>
                            <th>Tanggal Request</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($DataRequest as $item)
                            <tr>
                                <td><img src="{{ env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"> &nbsp; {{ $item['Merchant']['bussinesName'] }}</td>
                                <td>{{ $item['noResi'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['Service']['service'] }}</td>
                                <td>{{ $item['paymentStatus'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['noResi'] }}')">Assign Driver</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="hold" role="tabpanel" aria-labelledby="hold-tab">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Service</th>
                            <th>Payment Status</th>
                            <th>Tanggal Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($DataOnHold as $item)
                            <tr>
                                <td><img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"> &nbsp; {{ $item['Merchant']['bussinesName'] }}</td>
                                <td>{{ $item['noResi'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['Service']['service'] }}</td>
                                <td>{{ $item['paymentStatus'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['noResi'] }}')">View Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pickup" role="tabpanel" aria-labelledby="pickup-tab">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Service</th>
                            <th>Payment Status</th>
                            <th>Tanggal Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($DataOnPickup as $item)
                            <tr>
                                <td><img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"> &nbsp; {{ $item['Merchant']['bussinesName'] }}</td>
                                <td>{{ $item['noResi'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['Service']['service'] }}</td>
                                <td>{{ $item['paymentStatus'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['noResi'] }}')">View Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Service</th>
                            <th>Payment Status</th>
                            <th>Tanggal Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($DataOnDelivery as $item)
                            <tr>
                                <td><img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"> &nbsp; {{ $item['Merchant']['bussinesName'] }}</td>
                                <td>{{ $item['noResi'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['Service']['service'] }}</td>
                                <td>{{ $item['paymentStatus'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['noResi'] }}')">View Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Business Name</th>
                            <th>No Resi</th>
                            <th>Status</th>
                            <th>Service</th>
                            <th>Payment Status</th>
                            <th>Tanggal Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($DataDone as $item)
                            <tr>
                                <td><img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"> &nbsp; {{ $item['Merchant']['bussinesName'] }}</td>
                                <td>{{ $item['noResi'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['Service']['service'] }}</td>
                                <td>{{ $item['paymentStatus'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="fetchDetail('{{ $item['noResi'] }}')">View Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          </div>
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
                        @if($shippingDetail)
                            <div class="container">
                                @if ($shippingDetail['status'] == "Requested")
                                <div class="card radius-10 overflow-hidden w-100" x-data="{ showBody: @entangle('showBody') }">
                                    <div class="card-header" @click="showBody = !showBody">
                                        Assign Driver
                                    </div>
                                    <div class="card-body" x-show="showBody" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-90">
                                        <div class="d-flex flex-column gap-2">
                                            @forelse ($drivers as $item)
                                                <div class="card border shadow-none radius-10 mb-0">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="country-icon">
                                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect width="40" height="40" rx="8" fill="#CEDEFF"/>
                                                                    <path d="M20 30C19.182 30 18.4 29.675 16.837 29.026C12.946 27.41 11 26.602 11 25.243V15.745M20 30C20.818 30 21.6 29.675 23.163 29.026C27.054 27.41 29 26.602 29 25.243V15.745M20 30V20.169M11 15.745C11 16.348 11.802 16.73 13.405 17.492L16.325 18.882C18.13 19.74 19.03 20.17 20 20.17C20.97 20.17 21.87 19.74 23.675 18.882L26.595 17.492C28.198 16.73 29 16.348 29 15.745M11 15.745C11 15.141 11.802 14.759 13.405 13.997L15.5 13M29 15.745C29 15.141 28.198 14.76 26.595 13.998L24.5 13M14 21.152L16 22.135M20.004 10V17M20.004 17C20.267 17.004 20.526 16.82 20.718 16.595L22 15.062M20.004 17C19.75 16.997 19.493 16.814 19.29 16.595L18 15.062" stroke="#165EF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </div>
                                                            <div class="country-name flex-grow-1">
                                                                <h5 class="mb-0">{{ $item['fullName'] }}</h5>
                                                                <p class="mb-0 text-secondary">{{ $item['keterangan'] }}</p>
                                                            </div>
                                                            <div class="">
                                                                <p class="mb-0 text-success d-flex gap-1 align-items-center fw-500">
                                                                    <span>
                                                                        <form wire:submit.prevent="assignDriver({{ $item['id'] }})">
                                                                            {{-- @csrf --}}
                                                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                    <path d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No drivers available</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Business Information</h6>
                                        <p><strong>Business Name:</strong> {{ $shippingDetail['Merchant']['bussinesName'] }}</p>
                                        <p><strong>Logo:</strong>
                                            @if($shippingDetail['Merchant']['logo'])
                                                <img src="{{ asset(env('API_BASE_URL_ORIGIN').$shippingDetail['Merchant']['logo']) }}" alt="Logo" width="50">
                                            @else
                                                No Logo Available
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Branch Information</h6>
                                        <p><strong>PIC:</strong> {{ $shippingDetail['Branch']['pic'] }}</p>
                                        <p><strong>Contact:</strong> {{ $shippingDetail['Branch']['contact'] }}</p>
                                        <p><strong>Alamat:</strong> {{ $shippingDetail['Branch']['alamat'] }}</p>
                                        <p><strong>Provinsi:</strong> {{ $shippingDetail['Branch']['Provinsi']['provinsi'] }}</p>
                                        <p><strong>Kota:</strong> {{ $shippingDetail['Branch']['Kabupaten']['kabupaten'] }}</p>
                                        <p><strong>Kecamatan:</strong> {{ $shippingDetail['Branch']['Kecamatan']['kecamatan'] }}</p>
                                        <p><strong>Kelurahan:</strong> {{ $shippingDetail['Branch']['kelurahan'] }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Information</h6>
                                        <p><strong>No Resi:</strong> {{ $shippingDetail['noResi'] }}</p>
                                        <p><strong>Status:</strong> {{ $shippingDetail['status'] }}</p>
                                        <p><strong>Service:</strong> {{ $shippingDetail['Service']['service'] }}</p>
                                        <p><strong>Payment Status:</strong> {{ $shippingDetail['paymentStatus'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Receiver Information</h6>
                                        <p><strong>Nama Penerima:</strong> {{ $shippingDetail['namaPenerima'] }}</p>
                                        <p><strong>Alamat Penerima:</strong> {{ $shippingDetail['alamatPenerima'] }}</p>
                                        <p><strong>Nomor Penerima:</strong> {{ $shippingDetail['contactPenerima'] }}</p>
                                        <p><strong>Provinsi Penerima:</strong> {{ $shippingDetail['Provinsi']['provinsi'] }}</p>
                                        <p><strong>Kota Penerima:</strong> {{ $shippingDetail['Kabupaten']['kabupaten'] }}</p>
                                        <p><strong>Kecamatan Penerima:</strong> {{ $shippingDetail['Kecamatan']['kecamatan'] }}</p>
                                    </div>
                                </div>
                                <hr>
                                <h6>Products</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul>
                                            @foreach($shippingDetail['products'] as $product)
                                                <li>{{ $product['product'] }} ({{ $product['quantity'] }})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <h6>Cost Information</h6>
                                <p><strong>Total Checkout:</strong> Rp{{ number_format($shippingDetail['totalCheckout'], 2) }}</p>
                                <p><strong>Ongkir:</strong> Rp{{ number_format($shippingDetail['ongkir'], 2) }}</p>
                                <p><strong>Total Cost:</strong> Rp{{ number_format($shippingDetail['totalCheckout'] + $shippingDetail['ongkir'], 2) }}</p>
                                @if ($shippingDetail['status'] == 'Done')
                                    <img src="{{ env('API_BASE_URL_ORIGIN').$shippingDetail['buktiShipping'] }}" width="100px" alt="buktiShipping">
                                @endif
                                <hr>
                                <h6>Shipping Logs</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul>
                                            @foreach($shippingDetail['logs'] as $log)
                                                <li>{{ $log['tanggal'] }} {{ $log['jam'] }} - {{ $log['keterangan'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Loading...</p>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var hash = window.location.hash;
        if (hash) {
            var targetTab = document.querySelector('button[data-bs-target="' + hash + '"]');
            if (targetTab) {
                var tab = new bootstrap.Tab(targetTab);
                tab.show();
            }
        }
    });
</script>
<script>
    // Save active tab to localStorage
    document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(tab) {
        tab.addEventListener('shown.bs.tab', function(event) {
            localStorage.setItem('activeTab', event.target.id);
        });
    });

    // Get active tab from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            var tabElement = document.getElementById(activeTab);
            var tab = new bootstrap.Tab(tabElement);
            tab.show();
        }
    });
</script>
