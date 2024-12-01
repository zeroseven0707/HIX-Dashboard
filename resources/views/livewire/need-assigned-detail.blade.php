<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary"><i class="fas fa-shipping-fast"></i>Detail Shipping Need Assigned</h4>
                <button wire:click="back" class="btn btn-outline-primary btn-sm mt-3">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                {{-- <button wire:click="assignDriver" class="btn btn-primary mt-3">Assign Driver</button> --}}
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (!empty($details))
                @if (!empty($details['kecamatan'] || !empty($details['meta'])))
                    <div class="mb-3 text-muted">
                        <span class="badge text-bg-secondary text-uppercase"
                            style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-map-marker-alt"></i> Kecamatan: {{ $details['kecamatan']['kecamatan'] }}
                        </span>
                        <span class="badge text-bg-warning text-light text-uppercase"
                            style="font-size: 0.8rem; padding: 0.5rem 1rem;">
                            <i class="fas fa-box"></i> Total Paket: {{ $details['meta']['total'] }}
                        </span>
                    </div>
                @endif
                <div class="card radius-10 overflow-hidden w-100" x-data="{ showBody: @entangle('showBody') }">
                    <div class="card-header" @click="showBody = !showBody">
                        <i class="fas fa-truck-moving"></i> <strong>Assign Driver</strong>
                    </div>
                    <div class="card-body" x-show="showBody" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90">

                        <!-- Scrollable driver list container -->
                        <div class="d-flex flex-column gap-2" style="max-height: 300px; overflow-y: auto;">
                            @forelse ($drivers as $item)
                                <div class="card border shadow-none radius-10 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="country-icon">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="8" fill="#CEDEFF" />
                                                    <path
                                                        d="M20 30C19.182 30 18.4 29.675 16.837 29.026C12.946 27.41 11 26.602 11 25.243V15.745M20 30C20.818 30 21.6 29.675 23.163 29.026C27.054 27.41 29 26.602 29 25.243V15.745M20 30V20.169M11 15.745C11 16.348 11.802 16.73 13.405 17.492L16.325 18.882C18.13 19.74 19.03 20.17 20 20.17C20.97 20.17 21.87 19.74 23.675 18.882L26.595 17.492C28.198 16.73 29 16.348 29 15.745M11 15.745C11 15.141 11.802 14.759 13.405 13.997L15.5 13M29 15.745C29 15.141 28.198 14.76 26.595 13.998L24.5 13M14 21.152L16 22.135M20.004 10V17M20.004 17C20.267 17.004 20.526 16.82 20.718 16.595L22 15.062M20.004 17C19.75 16.997 19.493 16.814 19.29 16.595L18 15.062"
                                                        stroke="#165EF0" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
                                                            <button type="submit"
                                                                class="btn btn-link p-0 m-0 align-baseline">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z"
                                                                        stroke="#373737" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17"
                                                                        stroke="#373737" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
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
                        <!-- End of scrollable driver list -->
                    </div>
                </div>


                <div class="row">
                    @foreach ($details['paket'] as $index => $package)
                        <div class="col col-md-6">
                            <div class="card mb-4 border-left-primary shadow">
                                <div class="card-header bg-primary text-light" data-toggle="collapse"
                                    href="#package-{{ $index }}" role="button" aria-expanded="false"
                                    aria-controls="package-{{ $index }}">
                                    <h5 class="card-title d-flex justify-content-between align-items-center">
                                        <span class="text-decoration-none">
                                            <i class="fas fa-box-open"></i> {{ $package['noResi'] }}
                                            <i class="ml-2 fas fa-caret-down"></i>
                                        </span>
                                        <small class="text-light"><i class="fas fa-user"></i>
                                            {{ $package['namaPenerima'] }}</small>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="collapse" id="package-{{ $index }}">
                                        <!-- Status Badge -->
                                        <div class="mb-2 d-flex justify-content-end">
                                            <span class="badge text-bg-info text-light">
                                                <i class="fas fa-info-circle"></i> {{ $package['status'] }}
                                            </span>
                                        </div>

                                        <!-- Package Info -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><i class="fas fa-user"></i> Informasi Penerima</h6>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="compact-text">
                                                                <strong>{{ $package['namaPenerima'] }}</strong>
                                                            </p>
                                                            <p class="compact-text">{{ $package['contactPenerima'] }}
                                                            </p>
                                                        </div>
                                                        <p class="compact-text">{{ $package['alamatPenerima'] }}</p>
                                                        <div class="mt-2">
                                                            <p class="compact-text text-start">
                                                                <button class="btn btn-outline-success btn-sm w-100">
                                                                    <i class="fas fa-shopping-cart"></i> Total Checkout
                                                                    Rp.
                                                                    {{ number_format($package['totalCheckout'], 2, ',', '.') }}
                                                                </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product List -->
                                        <h6><i class="fas fa-box"></i> Products</h6>
                                        <ul class="list-group mb-3">
                                            @foreach ($package['products'] as $product)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $product['product'] }}
                                                    <span class="badge badge-primary badge-pill">Quantity:
                                                        {{ $product['quantity'] }}</span>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <!-- Log Timeline -->
                                        <h6><i class="fas fa-history"></i> Logs</h6>
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="list-group timeline mb-3">
                                                    @foreach ($package['logs'] as $log)
                                                        <li class="list-group-item">
                                                            <span class="text-muted">{{ $log['tanggal'] }}
                                                                {{ date('H:i', strtotime($log['jam'])) }}</span> -
                                                            {{ $log['keterangan'] }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                {{-- @if (!empty($details['meta']))
                    <div class="text-center mt-3">
                        <p>Halaman {{ $details['meta']['page'] }} dari {{ $details['meta']['last_page'] }}</p>
                        <p>Total Paket: {{ $details['meta']['total'] }}</p>
                    </div>
                @endif --}}
            @else
                <p class="text-muted">No details available.</p>
            @endif
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
