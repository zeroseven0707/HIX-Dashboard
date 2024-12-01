  <!-- start page content wrapper-->
  <div class="page-content-wrapper"> <!-- start page content-->
      <div class="page-content mt-0">
          {{-- @if (session()->has('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif

          @if (session()->has('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif --}}
          @if (session('success'))
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      html: "{!! session('success') !!}",
                      confirmButtonText: 'OK'
                  });
              </script>
          @endif

          @if (session('error'))
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Failed!',
                      html: "{!! session('error') !!}", // Use `html` to allow multiline messages
                      confirmButtonText: 'OK'
                  });
              </script>
          @endif
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab"
                      aria-controls="new" aria-selected="true">New Request</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="hold-tab" data-toggle="tab" href="#hold" role="tab"
                      aria-controls="hold" aria-selected="false">On Hold</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="assigned-tab" data-toggle="tab" href="#assigned" role="tab"
                      aria-controls="assigned" aria-selected="false">Assigned</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab"
                      aria-controls="pickup" aria-selected="false">On Pickup</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab"
                      aria-controls="delivery" aria-selected="false">On Delivery</a>
              </li>
              <li class="nav-item" role="presentation">
                  <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab"
                      aria-controls="done" aria-selected="false">Shipping Done</a>
              </li>
          </ul>

          <div class="card p-3 shadow">
              <div class="card-body">
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
                                      <th>Jam Request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataRequest as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}</td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <a href="{{ url('/shipping-request-detail' . '/' . $item['noResi']) }}">
                                                  <button class="btn btn-primary">Assign Driver</button>
                                              </a>

                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['request']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="request({{ $pagination['request']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['request']['currentPage'] }} of
                                  {{ $pagination['request']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['request']['currentPage'] == $pagination['request']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="request({{ $pagination['request']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>

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
                                      <th>Jam Request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataOnHold as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <a href="{{ url('/shipping-request-detail' . '/' . $item['noResi']) }}">
                                                  <button class="btn btn-primary">Assign Driver</button>
                                              </a>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>

                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['onHold']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="onHold({{ $pagination['onHold']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['onHold']['currentPage'] }} of
                                  {{ $pagination['onHold']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['onHold']['currentPage'] == $pagination['onHold']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="onHold({{ $pagination['onHold']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
                          <table class="table align-middle mb-0">
                              <thead class="table-light">
                                  <tr>
                                      <th>BusinessName</th>
                                      <th>No Resi</th>
                                      <th>Status</th>
                                      <th>Service</th>
                                      <th>Payment Status</th>
                                      <th>Tanggal Request</th>
                                      <th>Jam Request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataAssigned as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['noResi'] }}')">View
                                                  Detail</button>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>

                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['onHold']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="onHold({{ $pagination['onHold']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['onHold']['currentPage'] }} of
                                  {{ $pagination['onHold']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['onHold']['currentPage'] == $pagination['onHold']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="onHold({{ $pagination['onHold']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>
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
                                      <th>Jam request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataOnPickup as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['noResi'] }}')">View
                                                  Detail</button>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['onPickup']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="onPickup({{ $pagination['onPickup']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['onPickup']['currentPage'] }} of
                                  {{ $pagination['onPickup']['currentPage'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['onPickup']['currentPage'] == $pagination['onPickup']['totalPages'] ? 'disabled' : 'disabled' }}
                                  wire:click="onPickup({{ $pagination['onPickup']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>

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
                                      <th>Jam Request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataOnDelivery as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['noResi'] }}')">View
                                                  Detail</button>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['onDelivery']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="onDelivery({{ $pagination['onDelivery']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['onDelivery']['currentPage'] }} of
                                  {{ $pagination['onDelivery']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['onDelivery']['currentPage'] == $pagination['onDelivery']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="onDelivery({{ $pagination['onDelivery']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>
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
                                      <th>Jam Request</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($DataDone as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <div class="country-icon2">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $item['Merchant']['logo']) }}"
                                                          alt="Logo" width="50">
                                                  </div>
                                                  <div class="ms-2">
                                                      {{ $item['Merchant']['bussinesName'] }}
                                                  </div>
                                              </div>
                                          </td>
                                          <td>{{ $item['noResi'] }}</td>
                                          <td>
                                              <span class="badge bg-primary">{{ $item['status'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-warning">{{ $item['Service']['service'] }}</span>
                                          </td>
                                          <td>
                                              <span class="badge bg-success">{{ $item['paymentStatus'] }}</span>
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y') }}
                                          </td>
                                          <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('H:i') }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['noResi'] }}')">View
                                                  Detail</button>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="7">No data available</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                          <!-- Pagination Controls -->
                          <div class="pagination-controls mt-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['Done']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="Done({{ $pagination['Done']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['Done']['currentPage'] }} of
                                  {{ $pagination['Done']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['Done']['currentPage'] == $pagination['Done']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="Done({{ $pagination['Done']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div>
                      </div>
                      <div class="modal fade @if ($showDetailModal) show @endif" tabindex="-1"
                          role="dialog"
                          style="@if ($showDetailModal) display: block; @else display: none; @endif">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content rounded-3 shadow-lg">
                                  <div class="modal-header border-bottom-0 bg-primary text-white">
                                      <h5 class="modal-title">Shipping Details</h5>
                                      <button type="button" class="btn-close" wire:click="closeModal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      @if ($shippingDetail)
                                          <div class="container">
                                              @if ($shippingDetail['status'] == 'Requested')
                                                  <div class="card mb-4">
                                                      <div
                                                          class="card-header d-flex justify-content-between align-items-center">
                                                          <span><i class="fas fa-truck-moving"></i> Assign
                                                              Driver</span>
                                                          <button class="btn btn-link" data-bs-toggle="collapse"
                                                              data-bs-target="#assignDriver" aria-expanded="false">
                                                              <i class="fas fa-chevron-down"></i>
                                                          </button>
                                                      </div>
                                                      <div class="collapse" id="assignDriver">
                                                          <div class="card-body">
                                                              <div class="d-flex flex-column gap-2">
                                                                  @forelse ($drivers as $item)
                                                                      <div class="card border shadow-none mb-2">
                                                                          <div class="card-body">
                                                                              <div
                                                                                  class="d-flex align-items-center justify-content-between">
                                                                                  <div
                                                                                      class="d-flex align-items-center gap-3">
                                                                                      <div class="country-icon">
                                                                                          <svg width="40"
                                                                                              height="40"
                                                                                              viewBox="0 0 40 40"
                                                                                              fill="none"
                                                                                              xmlns="http://www.w3.org/2000/svg">
                                                                                              <rect width="40"
                                                                                                  height="40"
                                                                                                  rx="8"
                                                                                                  fill="#CEDEFF" />
                                                                                              <path
                                                                                                  d="M20 30C19.182 30 18.4 29.675 16.837 29.026C12.946 27.41 11 26.602 11 25.243V15.745M20 30C20.818 30 21.6 29.675 23.163 29.026C27.054 27.41 29 26.602 29 25.243V15.745M20 30V20.169M11 15.745C11 16.348 11.802 16.73 13.405 17.492L16.325 18.882C18.13 19.74 19.03 20.17 20 20.17C20.97 20.17 21.87 19.74 23.675 18.882L26.595 17.492C28.198 16.73 29 16.348 29 15.745M11 15.745C11 15.141 11.802 14.759 13.405 13.997L15.5 13M29 15.745C29 15.141 28.198 14.76 26.595 13.998L24.5 13M14 21.152L16 22.135M20.004 10V17M20.004 17C20.267 17.004 20.526 16.82 20.718 16.595L22 15.062M20.004 17C19.75 16.997 19.493 16.814 19.29 16.595L18 15.062"
                                                                                                  stroke="#165EF0"
                                                                                                  stroke-width="1.5"
                                                                                                  stroke-linecap="round"
                                                                                                  stroke-linejoin="round" />
                                                                                          </svg>
                                                                                      </div>
                                                                                      <div
                                                                                          class="country-name flex-grow-1">
                                                                                          <h5 class="mb-0">
                                                                                              {{ $item['fullName'] }}
                                                                                          </h5>
                                                                                          <p
                                                                                              class="mb-0 text-secondary">
                                                                                              {{ $item['keterangan'] }}
                                                                                          </p>
                                                                                      </div>
                                                                                  </div>
                                                                                  <form
                                                                                      wire:submit.prevent="assignDriver({{ $item['id'] }})">
                                                                                      <button type="submit"
                                                                                          class="btn btn-outline-success btn-sm">
                                                                                          <i class="fas fa-check"></i>
                                                                                          Assign
                                                                                      </button>
                                                                                  </form>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  @empty
                                                                      <p class="text-danger">No drivers available</p>
                                                                  @endforelse
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              @endif

                                              <div class="row">
                                                  <!-- Business Information -->
                                                  <div class="col col-md-4">
                                                      <h6><i class="fas fa-building"></i> Business Information</h6>
                                                      <div class="mt-4 d-flex flex-column align-items-center mb-3">
                                                          @if ($shippingDetail['Merchant']['logo'])
                                                              <div class="country-icon3 mb-2">
                                                                  <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $shippingDetail['Merchant']['logo']) }}"
                                                                      alt="Logo" width="100"
                                                                      class="img-fluid">
                                                              </div>
                                                              <p class="text-center">
                                                                  <strong>{{ $shippingDetail['Merchant']['bussinesName'] }}</strong>
                                                              </p>
                                                          @else
                                                              <p>No Logo Available</p>
                                                          @endif
                                                      </div>
                                                  </div>

                                                  <!-- Branch Information -->

                                                  <div class="col-md-8">
                                                      <h6><i class="fas fa-user"></i> Branch Information</h6>
                                                      <table class="table">
                                                          <tr>
                                                              <td><strong>PIC</strong></td>
                                                              <td>: {{ $shippingDetail['Branch']['pic'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Contact</strong></td>
                                                              <td>: {{ $shippingDetail['Branch']['contact'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Alamat</strong></td>
                                                              <td>: {{ $shippingDetail['Branch']['alamat'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Provinsi</strong></td>
                                                              <td>:
                                                                  {{ $shippingDetail['Branch']['Provinsi']['provinsi'] }}
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Kota</strong></td>
                                                              <td>:
                                                                  {{ $shippingDetail['Branch']['Kabupaten']['kabupaten'] }}
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Kecamatan</strong></td>
                                                              <td>:
                                                                  {{ $shippingDetail['Branch']['Kecamatan']['kecamatan'] }}
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Kelurahan</strong></td>
                                                              <td>: {{ $shippingDetail['Branch']['kelurahan'] }}</td>
                                                          </tr>
                                                      </table>
                                                  </div>
                                              </div>
                                              <div class="row mb-4">
                                              </div>
                                              <hr>

                                              <div class="row mb-4">
                                                  <!-- Shipping Information -->
                                                  <div class="col-md-4">
                                                      <h6><i class="fas fa-shipping-fast"></i> Shipping Information
                                                      </h6>
                                                      <button
                                                          class="btn btn-light text-primary  btn-sm w-100 mb-2 text-start">No
                                                          Resi<br>{{ $shippingDetail['noResi'] }}</button>
                                                      <button
                                                          class="btn btn-info btn-sm text-light w-100 mb-2 text-start">Service
                                                          {{ $shippingDetail['Service']['service'] }}</button>
                                                      <button
                                                          class="btn btn-warning btn-sm text-light w-100 mb-2 text-start">Status
                                                          {{ $shippingDetail['status'] }}</button>
                                                  </div>

                                                  <!-- Receiver Information -->
                                                  <div class="col-md-8">
                                                      <h6><i class="fas fa-receipt"></i> Receiver Information</h6>
                                                      <table class="table">
                                                          <tr>
                                                              <td><strong>Nama Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['namaPenerima'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Alamat Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['alamatPenerima'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Nomor Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['contactPenerima'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Provinsi Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['Provinsi']['provinsi'] }}</td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Kota Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['Kabupaten']['kabupaten'] }}
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Kecamatan Penerima</strong></td>
                                                              <td>: {{ $shippingDetail['Kecamatan']['kecamatan'] }}
                                                              </td>
                                                          </tr>
                                                      </table>

                                                  </div>
                                              </div>
                                              <hr>

                                              <div class="row">
                                                  <div class="col col-md-6">
                                                      <!-- Product -->
                                                      <h6><i class="fas fa-box"></i> Product</h6>
                                                      @foreach ($shippingDetail['products'] as $product)
                                                          <div class="card">
                                                              <div class="card-body">
                                                                  <div class="d-flex align-items-start gap-2">
                                                                      <div>
                                                                          <p class="mb-0 fs-6">
                                                                              {{ $product['product'] }}
                                                                          </p>
                                                                          <small style="color: gray">Quantity :
                                                                              ({{ $product['quantity'] }})
                                                                          </small>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      @endforeach
                                                  </div>
                                                  <div class="col col-md-6">
                                                      <!-- Fee Detail -->
                                                      <h6><i class="fas fa-box"></i> Fee Detail</h6>

                                                      <!-- Payment Status -->
                                                      <button
                                                          class="btn btn-light text-dark w-100 mb-2 d-flex justify-content-between align-items-center">
                                                          <span>Payment Status</span>
                                                          <span>{{ $shippingDetail['paymentStatus'] }}</span>
                                                      </button>

                                                      <!-- Checkout -->
                                                      <button
                                                          class="btn btn-light text-info w-100 mb-2 d-flex justify-content-between align-items-center">
                                                          <span>Checkout</span>
                                                          <span>Rp.
                                                              {{ $shippingDetail['totalCheckout'] }}</span>
                                                      </button>

                                                      <!-- Ongkir -->
                                                      <button
                                                          class="btn btn-light text-danger w-100 mb-2 d-flex justify-content-between align-items-center">
                                                          <span>Ongkir</span>
                                                          <span>Rp. {{ $shippingDetail['ongkir'] }}</span>
                                                      </button>

                                                      <!-- Total -->
                                                      <button
                                                          class="btn btn-light text-success w-100 mb-2 d-flex justify-content-between align-items-center">
                                                          <span>Total</span>
                                                          <span>Rp.
                                                              {{ $shippingDetail['ongkir'] + $shippingDetail['totalCheckout'] }}</span>
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- Shipping Logs -->
                                          <h6><i class="fas fa-history"></i> Shipping Logs</h6>
                                          <ul class="list-group timeline mb-3">
                                              @foreach ($shippingDetail['logs'] as $log)
                                                  <li class="list-group-item">
                                                      <span class="text-muted">{{ $log['tanggal'] }}
                                                          {{ date('H:i', strtotime($log['jam'])) }}</span> -
                                                      {{ $log['keterangan'] }}
                                                  </li>
                                              @endforeach
                                          </ul>
                                          <hr>
                                          <!-- Upload Shipping Receipt -->
                                          <h6><i class="fas fa-upload"></i> Bukti Pengiriman</h6>
                                          @if ($shippingDetail['buktiShipping'])
                                              <div
                                                  class="mb-2 country-icon3 d-flex align-items-center justify-content-center">
                                                  <div class="div">
                                                      <img src="{{ asset(env('API_BASE_URL_ORIGIN') . $shippingDetail['buktiShipping']) }}"
                                                          alt="Bukti Shipping" class="img-fluid">
                                                  </div>
                                              </div>
                                          @else
                                              <div class="alert alert-warning">
                                                  Bukti pengiriman belum tersedia
                                              </div>
                                          @endif
                                          <hr>
                                  </div>
                                  <hr>
                              @else
                                  <p class="text-center">Loading...</p>
                                  @endif
                                  <div class="modal-footer border-top-0">
                                      <button type="button" class="btn btn-secondary"
                                          wire:click="closeModal">Close</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- <script>
      document.addEventListener('DOMContentLoaded', function() {
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
  </script> --}}

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const navLinks = document.querySelectorAll('.nav-link');

          // Handle tab click events
          navLinks.forEach(link => {
              link.addEventListener('click', function(event) {
                  event.preventDefault(); // Prevent default anchor behavior
                  const href = this.getAttribute('href');

                  // Update the URL without reloading the page
                  history.pushState(null, '', href);

                  // Activate the clicked tab and deactivate others
                  navLinks.forEach(nav => {
                      nav.classList.remove('active');
                  });
                  this.classList.add('active');

                  // Show the related tab content and hide others
                  const tabContents = document.querySelectorAll('.tab-pane');
                  tabContents.forEach(tabContent => {
                      tabContent.classList.remove('show', 'active');
                  });
                  document.querySelector(href).classList.add('show', 'active');

                  // Save active tab to localStorage
                  localStorage.setItem('activeTab', this.id);
              });
          });

          // Handle browser navigation (back/forward)
          window.addEventListener('popstate', function() {
              const activeTabId = location.hash.substring(1);
              if (activeTabId) {
                  const activeLink = document.querySelector('.nav-link[href="#' + activeTabId + '"]');
                  if (activeLink) {
                      activeLink.click();
                  }
              }
          });

          // Get active tab from localStorage
          const activeTabId = localStorage.getItem('activeTab');
          if (activeTabId) {
              const tabElement = document.getElementById(activeTabId);
              if (tabElement) {
                  tabElement.click(); // Activate the stored tab on page load
              }
          } else {
              // Activate the first tab if no active tab is stored
              navLinks[0].click();
          }
      });
  </script>
