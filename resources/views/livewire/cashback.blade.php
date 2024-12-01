  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">
          <div class="container">
              <div class="card shadow">
                  <div class="card-header">
                      <h5 class="card-title">Cashback</h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-striped">
                              <thead class="thead-dark">
                                  <tr>
                                      <th>Merchant ID</th>
                                      <th>Business Name</th>
                                      <th>Instant Cashback</th>
                                      <th>Actions</th>
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
                                                  Rp. {{ $instant['cashback'] }} ({{ $instant['Service']['service'] }}
                                                  -
                                                  {{ $instant['UnitKendaraan']['unitKendaraan'] }})
                                              @endforeach
                                          </td>
                                          <td>
                                              <button class="btn btn-primary btn-sm"
                                                  wire:click="viewDetail({{ $cashback['cashback_instant'][0]['id'] ?? $cashback['cashback_same_day'][0]['id'] }})">Update</button>
                                          </td>
                                          <td>
                                              @foreach ($cashback['cashback_same_day'] as $sameDay)
                                                  Rp. {{ $sameDay['cashback'] }} ({{ $sameDay['Service']['service'] }} -
                                                  {{ $sameDay['UnitKendaraan']['unitKendaraan'] }})
                                              @endforeach
                                          </td>
                                          <td>
                                              <button class="btn btn-primary btn-sm"
                                                  wire:click="viewDetail({{ $cashback['cashback_same_day'][0]['id'] ?? $cashback['cashback_instant'][0]['id'] }})">Update</button>
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
                      <!-- Pagination Links -->
                      @if ($pagination)
                          <div class="d-flex justify-content-center">
                              <nav aria-label="Page navigation">
                                  <ul class="pagination">
                                      <!-- Previous Page Link -->
                                      @if ($currentPage > 1)
                                          <li class="page-item">
                                              <a class="page-link" href="#"
                                                  wire:click.prevent="fetchCashbacks({{ $currentPage - 1 }})"
                                                  aria-label="Previous">
                                                  <span aria-hidden="true">&laquo;</span>
                                              </a>
                                          </li>
                                      @endif

                                      <!-- Page Numbers -->
                                      @for ($i = 1; $i <= $totalPages; $i++)
                                          <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                              <a class="page-link" href="#"
                                                  wire:click.prevent="fetchCashbacks({{ $i }})">{{ $i }}</a>
                                          </li>
                                      @endfor

                                      <!-- Next Page Link -->
                                      @if ($currentPage < $totalPages)
                                          <li class="page-item">
                                              <a class="page-link" href="#"
                                                  wire:click.prevent="fetchCashbacks({{ $currentPage + 1 }})"
                                                  aria-label="Next">
                                                  <span aria-hidden="true">&raquo;</span>
                                              </a>
                                          </li>
                                      @endif
                                  </ul>
                              </nav>
                          </div>
                      @endif

                  </div>
              </div>

              @if ($detail)
                  <div class="modal fade show d-block" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-md" role="document">
                          <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                  <h5 class="modal-title"><i class="fas fa-info-circle"></i> Cashback Detail</h5>
                                  <button type="button" class="btn close text-white" wire:click="$set('detail', null)">
                                      <span>&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <div class="container-fluid">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="info-field">
                                                  <p class=""><i class="fas fa-tag text-primary"></i> ID :</p>
                                                  <p class="info-value ms-2"> {{ $detail['id'] }}</p>
                                              </div>
                                              <div class="info-field">
                                                  <p><i class="fas fa-money-bill-wave text-primary"></i> Cashback :</p>
                                                  <p class="info-value ms-2"> Rp. {{ $detail['cashback'] }}</p>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="info-field">
                                                  <p><i class="fas fa-store text-primary"></i> Merchant Name :</p>
                                                  <p class="info-value ms-2"> {{ $detail['Merchant']['bussinesName'] }}
                                                  </p>
                                              </div>
                                              <div class="info-field">
                                                  <p><i class="fas fa-user-tie text-primary"></i> Business Owner :
                                                  </p>
                                                  <p class="info-value ms-2">
                                                      {{ $detail['Merchant']['bussinesOwener'] }}</p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="info-field">
                                                  <p><i class="fas fa-th-large text-primary"></i> Category :</p>
                                                  <p class="info-value ms-2">
                                                      {{ $detail['Merchant']['KategoriUsaha']['kategori'] }}</p>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="info-field">
                                                  <p><i class="fas fa-tags text-primary"></i> Type :</p>
                                                  <p class="info-value ms-2">
                                                      {{ $detail['Merchant']['JenisUsaha']['jenisUsaha'] }}
                                                      ({{ $detail['Merchant']['JenisUsaha']['singkatan'] }})</p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="form-group">
                                                  <label for="cashbackAmount"><i class="fas fa-pencil-alt"></i> Update
                                                      Cashback Amount:</label>
                                                  <input type="number" class="form-control border-primary"
                                                      id="cashbackAmount" wire:model="cashbackAmount"
                                                      placeholder="Enter new amount">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer bg-light">
                                  <button type="button" class="btn btn-secondary" wire:click="$set('detail', null)">
                                      <i class="fas fa-times"></i> Close
                                  </button>
                                  <button type="button" class="btn btn-primary" wire:click="updateCashback">
                                      <i class="fas fa-save"></i> Save Changes
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-backdrop fade show"></div>
              @endif
          </div>
      </div>
  </div>
