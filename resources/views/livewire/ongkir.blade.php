  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">
          <div class="container">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="instant-tab" data-bs-toggle="tab" data-bs-target="#instant"
                          type="button" role="tab" aria-controls="instant" aria-selected="true">Instant</button>
                  </li>
                  <li class="nav-item" role="presentation">
                      <button class="nav-link" id="sameday-tab" data-bs-toggle="tab" data-bs-target="#sameday"
                          type="button" role="tab" aria-controls="sameday" aria-selected="true">SameDay</button>
                  </li>
              </ul>
              <div class="card shadow">
                  <div class="card-body">
                      <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="instant" role="tabpanel"
                              aria-labelledby="instant-tab">
                              <div class="table-responsive">
                                  <table class="table table-striped">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th>Merchant</th>
                                              <th>Service</th>
                                              <th>Unit Kendaraan</th>
                                              <th>Cost</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($dataInstan as $item)
                                              @foreach ($item['ongkir'] as $ongkir)
                                                  <tr>
                                                      <td>{{ $item['merchant']['bussinesName'] }}</td>

                                                      {{-- Service --}}
                                                      <td><span
                                                              class="badge bg-warning">{{ $ongkir['Service']['service'] }}</span>
                                                      </td>


                                                      {{-- Unit Kendaraan with Icons --}}
                                                      <td>
                                                          <span
                                                              class="badge bg-danger text-light">{{ $ongkir['UnitKendaraan']['unitKendaraan'] }}</span>
                                                      </td>

                                                      {{-- Cost with Badge --}}
                                                      <td>
                                                          <span class="badge bg-info">Rp.
                                                              {{ number_format($ongkir['cost'], '0', ',', '.') }}</span>
                                                      </td>

                                                      {{-- Action Button --}}
                                                      <td>
                                                          <button class="btn btn-primary btn-sm"
                                                              wire:click="viewDetail({{ $ongkir['id'] }})">
                                                              View Detail
                                                          </button>
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

                                  <!-- Pagination Controls -->
                                  <div class="pagination-controls mt-3">
                                      <button class="btn btn-secondary" {{ $currentPage == 1 ? 'disabled' : '' }}
                                          wire:click="fetchOngkirData({{ $totalPages - 1 }})">
                                          Previous
                                      </button>
                                      <span>Page {{ $currentPage }} of {{ $totalPages }}</span>
                                      <button class="btn btn-secondary"
                                          {{ $currentPage == $totalPages ? 'disabled' : '' }}
                                          wire:click="fetchOngkirData({{ $currentPage + 1 }})">
                                          Next
                                      </button>
                                  </div>
                              </div>
                          </div>

                          <!-- SameDay Tab -->
                          <div class="tab-pane fade show" id="sameday" role="tabpanel" aria-labelledby="sameday-tab">
                              <div class="table-responsive">
                                  <table class="table table-striped">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th>Merchant</th>
                                              <th>Service</th>
                                              <th>Unit Kendaraan</th>
                                              <th>Cost</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($dataSameday as $item)
                                              @foreach ($item['ongkir'] as $ongkir)
                                                  <tr>
                                                      <td>{{ $item['merchant']['bussinesName'] }}</td>

                                                      {{-- Service --}}
                                                      <td><span
                                                              class="badge bg-warning">{{ $ongkir['Service']['service'] }}</span>
                                                      </td>

                                                      {{-- Unit Kendaraan with Icons --}}
                                                      <td>
                                                          <span
                                                              class="badge bg-danger text-light">{{ $ongkir['UnitKendaraan']['unitKendaraan'] }}</span>
                                                      </td>

                                                      {{-- Cost with Badge --}}
                                                      <td>
                                                          <span class="badge bg-info">Rp.
                                                            {{ number_format($ongkir['cost'], '0', ',', '.') }}</span>
                                                      </td>

                                                      {{-- Action Button --}}
                                                      <td>
                                                          <button class="btn btn-primary btn-sm"
                                                              wire:click="viewDetail({{ $ongkir['id'] }})">
                                                              View Detail
                                                          </button>
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

                                  <!-- Pagination Controls -->
                                  <div class="pagination-controls mt-3">
                                      <button class="btn btn-secondary" {{ $currentPage == 1 ? 'disabled' : '' }}
                                          wire:click="fetchOngkirData({{ $totalPages - 1 }})">
                                          Previous
                                      </button>
                                      <span>Page {{ $currentPage }} of {{ $totalPages }}</span>
                                      <button class="btn btn-secondary"
                                          {{ $currentPage == $totalPages ? 'disabled' : '' }}
                                          wire:click="fetchOngkirData({{ $currentPage + 1 }})">
                                          Next
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              @if ($details)
                  <div class="modal show d-block" tabindex="-1">
                      <div class="modal-dialog modal-md">
                          <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                  <h5 class="modal-title"><i class="fas fa-shipping-fast"></i> Detail Ongkir</h5>
                                  <button type="button" class=" btn btn-close"
                                      wire:click="$set('details', null)"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="container-fluid">
                                      <div class="info-field mb-3">
                                          <p class=""><i class="fas fa-store text-primary"></i> Merchant :</p>
                                          <p class="info-value ms-2">{{ $details['Merchant']['bussinesName'] }}</p>
                                      </div>
                                      <div class="info-field mb-3">
                                          <p class=""><i class="fas fa-money-bill-wave text-primary"></i> Cost :</p>
                                          <p class="info-value ms-2">Rp. {{ number_format($ongkir['cost'], '0', ',', '.') }}</p>
                                      </div>
                                      <div class="info-field mb-3">
                                          <p class=""><i class="fas fa-plus-circle text-primary"></i> Additional Cost :</p>
                                          <p class="info-value ms-2">Rp. {{ number_format($details['additionalCost'], '0', ',', '.') }}</p>
                                      </div>
                                      <form wire:submit.prevent="updateOngkir">
                                          <div class="row">
                                              <div class="col col-md-6">
                                                  <div class="mb-3">
                                                      <label for="cost" class="form-label"><i
                                                              class="fas fa-money-check-alt"></i> Cost</label>
                                                      <input type="number" class="form-control border-primary"
                                                          id="cost" wire:model="cost"
                                                          placeholder="Enter new cost">
                                                  </div>
                                              </div>
                                              <div class="col col-md-6">
                                                  <div class="mb-3">
                                                      <label for="additionalCost" class="form-label"><i
                                                              class="fas fa-plus-circle"></i> Additional Cost</label>
                                                      <input type="number" class="form-control border-primary"
                                                          id="additionalCost" wire:model="additionalCost"
                                                          placeholder="Enter additional cost">
                                                  </div>
                                              </div>
                                          </div>
                                  </div>
                              </div>
                              <div class="modal-footer bg-light">
                                  {{-- <button type="button" class="btn btn-secondary" wire:click="$set('detail', null)">
                                        <i class="fas fa-times"></i> Close
                                    </button> --}}
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                      Update</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              @endif
          </div>
      </div>
  </div>
