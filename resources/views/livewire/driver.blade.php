  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">
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
          <a href="/driver-registration">
              <button class="btn btn-primary btn-end mb-3">Daftar Driver Baru</button>
          </a>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="motor-tab" data-bs-toggle="tab" data-bs-target="#motor"
                      type="button" role="tab" aria-controls="motor" aria-selected="true">Motor</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="mobil-tab" data-bs-toggle="tab" data-bs-target="#mobil" type="button"
                      role="tab" aria-controls="mobil" aria-selected="true">Mobil</button>
              </li>
          </ul>

          <div class="card shadow">
              <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="motor" role="tabpanel" aria-labelledby="motor-tab">
                          <table class="table align-middle mb-0">
                              <thead class="table-light">
                                  <tr>
                                      <th>Foto</th>
                                      <th>Full Name</th>
                                      <th>Unit Kendaraan</th>
                                      <th>Contact</th>
                                      <th>Keterangan</th>
                                      <th colspan="2">Verif Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($dataMotor as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <img src="{{ env('API_BASE_URL_ORIGIN') . $item['foto'] }}"
                                                      alt="Foto Driver" class="img-thumbnail me-2"
                                                      style="width: 50px; height: 50px;">
                                                  <span>{{ $item['fullName'] }}</span>
                                              </div>
                                          </td>
                                          <td>{{ $item['fullName'] }}</td>
                                          <td>{{ $item['UnitKendaraan']['unitKendaraan'] }}</td>
                                          <td>{{ $item['contact'] }}</td>
                                          <td>
                                              @if ($item['keterangan'] === 'Active')
                                                  <span class="badge text-bg-success">{{ $item['keterangan'] }}</span>
                                              @else
                                                  <span class="badge text-bg-danger">{{ $item['keterangan'] }}</span>
                                              @endif
                                          </td>
                                          <td>{{ $item['verifStatus'] }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['id'] }}')">View Detail</button>
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
                      <div class="tab-pane fade show" id="mobil" role="tabpanel" aria-labelledby="mobil-tab">
                          <table class="table align-middle mb-0">
                              <thead class="table-light">
                                  <tr>
                                      <th>Driver</th>
                                      <th>Unit Kendaraan</th>
                                      <th>Contact</th>
                                      <th>Keterangan</th>
                                      <th colspan="2">Verif Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($dataMobil as $item)
                                      <tr>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <img src="{{ env('API_BASE_URL_ORIGIN') . $item['foto'] }}"
                                                      alt="Foto Driver" class="img-thumbnail me-2"
                                                      style="width: 50px; height: 50px;">
                                                  <span>{{ $item['fullName'] }}</span>
                                              </div>
                                          </td>
                                          <td>{{ $item['UnitKendaraan']['unitKendaraan'] }}</td>
                                          <td>{{ $item['contact'] }}</td>
                                          <td>
                                              @if ($item['keterangan'] === 'Active')
                                                  <span class="badge text-bg-success">{{ $item['keterangan'] }}</span>
                                              @else
                                                  <span class="badge text-bg-danger">{{ $item['keterangan'] }}</span>
                                              @endif
                                          </td>
                                          <td>{{ $item['verifStatus'] }}</td>
                                          <td>
                                              <button class="btn btn-primary"
                                                  wire:click="fetchDetail('{{ $item['id'] }}')">View Detail</button>
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
                          {{-- <div class="pagination-controls mt-3 mb-3">
                              <button class="btn btn-secondary"
                                  {{ $pagination['mobil']['currentPage'] == 1 ? 'disabled' : '' }}
                                  wire:click="mobil({{ $pagination['mobil']['totalPages'] - 1 }})">
                                  Previous
                              </button>

                              <span>Page {{ $pagination['mobil']['currentPage'] }} of
                                  {{ $pagination['mobil']['totalPages'] }}</span>

                              <button class="btn btn-secondary"
                                  {{ $pagination['mobil']['currentPage'] == $pagination['mobil']['totalPages'] ? 'disabled' : '' }}
                                  wire:click="mobil({{ $pagination['mobil']['currentPage'] + 1 }})">
                                  Next
                              </button>
                          </div> --}}
                      </div>
                  </div>
              </div>
          </div>

          <!-- Pagination Controls -->
          {{-- <div class="pagination-controls mt-3">
            <button class="btn btn-secondary" 
                    {{ $currentPage == 1 ? 'disabled' : '' }} 
                    wire:click="fetchDrivers({{ $currentPage - 1 }})">
                Previous
            </button>
            
            <span>Page {{ $currentPage }} of {{ $totalPages }}</span>
            
            <button class="btn btn-secondary" 
                    {{ $currentPage == $totalPages ? 'disabled' : '' }} 
                    wire:click="fetchDrivers({{ $currentPage + 1 }})">
                Next
            </button>
        </div> --}}

          <div class="modal fade @if ($showDetailModal) show @endif" tabindex="-1" role="dialog"
              style="@if ($showDetailModal) display: block; @else display: none; @endif">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                          <h5 class="modal-title">Driver Detail</h5>
                          <button type="button" class="btn btn-close" wire:click="closeModal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          @if ($driverDetail)
                              <div class="container">
                                  <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                      <div
                                          class="card-header text-center d-flex justify-content-between align-items-center">
                                          <div class="text-center flex-grow-1">
                                              <h4 class="card-title mb-0">{{ $driverDetail['fullName'] }}</h4>
                                              <p class="card-subtitle text-muted mb-0">
                                                  <i class="fas fa-phone"></i> {{ $driverDetail['contact'] }}
                                              </p>
                                          </div>
                                          <div>
                                              @if ($driverDetail['foto'])
                                                  <img src="{{ env('API_BASE_URL_ORIGIN') . $driverDetail['foto'] }}"
                                                      alt="Foto Driver" class="img-thumbnail"
                                                      style="width: 50px; height: 50px;">
                                              @else
                                                  <div class="bg-light"
                                                      style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                      <span class="text-muted">No Photo</span>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="card-body">
                                          <ul class="list-group list-group-flush">
                                              <li class="list-group-item">
                                                  <i class="fas fa-user-circle"></i> <strong>Contact:</strong>
                                                  {{ $driverDetail['contact'] }}
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fas fa-info-circle"></i> <strong>Status:</strong>
                                                  {{ $driverDetail['keterangan'] }}
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fas fa-check-circle"></i> <strong>Verification
                                                      Status:</strong> {{ $driverDetail['verifStatus'] }}
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fas fa-map-marker-alt"></i> <strong>Kecamatan:</strong>
                                                  {{ $driverDetail['Kecamatan']['kecamatan'] }}
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fas fa-map"></i> <strong>Provinsi:</strong>
                                                  {{ $driverDetail['Provinsi']['provinsi'] }}
                                              </li>
                                              <li class="list-group-item">
                                                  <i class="fas fa-building"></i> <strong>Kabupaten:</strong>
                                                  @if ($driverDetail['Kabupaten'])
                                                      {{ $driverDetail['Kabupaten']['kabupaten'] }}
                                                  @else
                                                      Tidak tersedia
                                                  @endif
                                              </li>
                                          </ul>
                                          <div class="mt-3">
                                              <div class="card mb-2">
                                                  <div
                                                      class="card-body text-center align-items-center d-flex flex-column">
                                                      <p><strong>Foto KTP:</strong></p>
                                                      @if ($driverDetail['ktp'] === null)
                                                          Foto Tidak Tersedia
                                                      @else
                                                          <div
                                                              style="width: 150px; height: 150px; overflow: hidden; display: flex; align-items: center; justify-content: center; position: relative;">
                                                              <img src="{{ env('API_BASE_URL_ORIGIN') . $driverDetail['ktp'] }}"
                                                                  alt="KTP" class="img-fluid"
                                                                  style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
                                                          </div>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>

                                          @if ($driverDetail['verifStatus'] == 'UnActive' || $driverDetail['verifStatus'] == 'Requested')
                                              <form wire:submit.prevent="verif('{{ $driverDetail['id'] }}')">
                                                  <button class='btn btn-danger float-end'>
                                                      <i class="fas fa-check"></i> Verifikasi
                                                  </button>
                                              </form>
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
  <script>
      document.addEventListener('livewire:initialized', () => {
          @this.on('swal', (event) => {
              const data = event
              swal.fire({
                  icon: data[0]['icon'],
                  title: data[0]['title'],
                  text: data[0]['text']
              })
          })
      })
  </script>
