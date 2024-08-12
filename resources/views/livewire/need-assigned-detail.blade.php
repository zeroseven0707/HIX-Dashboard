<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary">Detail Shipping Need Assigned</h2>
                {{-- <button wire:click="assignDriver" class="btn btn-primary mt-3">Assign Driver</button> --}}
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if(!empty($details))
                @if (!empty($details['kecamatan']))
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h4 class="card-title text-info">Kecamatan: {{ $details['kecamatan']['kecamatan'] }}</h4>
                        </div>
                    </div>
                @endif
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
                @foreach($details['paket'] as $index => $package)
                    <div class="card mb-4 border-left-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">
                                <a class="text-decoration-none text-dark" data-toggle="collapse" href="#package-{{ $index }}" role="button" aria-expanded="false" aria-controls="package-{{ $index }}">
                                    {{ $package['noResi'] }}<br>
                                    <small>penerima : {{ $package['namaPenerima'] }}</small>
                                </a>
                            </h5>
                            <div class="collapse" id="package-{{ $index }}">
                                <div class="mb-2">
                                    <span class="badge badge-info">{{ $package['status'] }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama Penerima:</strong> {{ $package['namaPenerima'] }}</p>
                                        <p><strong>Alamat Penerima:</strong> {{ $package['alamatPenerima'] }}</p>
                                        <p><strong>Kontak Penerima:</strong> {{ $package['contactPenerima'] }}</p>
                                        <p><strong>Total Checkout:</strong> {{ $package['totalCheckout'] }}</p>
                                    </div>
                                </div>

                                <h6 class="mt-3">Products</h6>
                                <ul class="list-group mb-3">
                                    @foreach($package['products'] as $product)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $product['product'] }} 
                                            <span class="badge badge-primary badge-pill">Quantity: {{ $product['quantity'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <h6>Logs</h6>
                                <ul class="list-group">
                                    @foreach($package['logs'] as $log)
                                        <li class="list-group-item">{{ $log['tanggal'] }} {{ $log['jam'] }} - {{ $log['keterangan'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (!empty($details['meta']))
                    <div class="pagination">
                        <p>Halaman {{ $details['meta']['page'] }} dari {{ $details['meta']['last_page'] }}</p>
                        <p>Total Paket: {{ $details['meta']['total'] }}</p>
                    </div>
                @endif
            @else
                <p class="text-muted">No details available.</p>
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
