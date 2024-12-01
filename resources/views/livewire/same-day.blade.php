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
          <div>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="request-tab" data-toggle="tab" href="#request" role="tab"
                          aria-controls="request" aria-selected="true">Request</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="on-hold-tab" data-toggle="tab" href="#on-hold" role="tab"
                          aria-controls="on-hold" aria-selected="false">On Hold</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="on-pickup-tab" data-toggle="tab" href="#on-pickup" role="tab"
                          aria-controls="on-pickup" aria-selected="false">On Pickup</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="need-assigned-tab" data-toggle="tab" href="#need-assigned" role="tab"
                          aria-controls="need-assigned" aria-selected="false">Need Assigned</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="on-delivery-tab" data-toggle="tab" href="#on-delivery" role="tab"
                          aria-controls="on-delivery" aria-selected="false">On Delivery</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab"
                          aria-controls="done" aria-selected="false">Done</a>
                  </li>
              </ul>
              <div class="card shadow">
                  <div class="card-body">
                      <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="request" role="tabpanel"
                              aria-labelledby="request-tab">
                              {{-- <h3>Request</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Merchant</th>
                                          <th>Branch Kecamatan</th>
                                          <th>Alamat Branch</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($DataRequest as $item)
                                          <tr>
                                              <td>{{ $item['merchant'] }}</td>
                                              <td>{{ $item['branch_kecamatan'] }}</td>
                                              <td class="alamat-column">{{ $item['alamat_branch'] }}</td>
                                              <td>
                                                  <span class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>{{ $item['total_shipping_sameday'] }}</td>
                                              <td>
                                                  <a href="{{ url('/sameday-request-detail' . '/' . $item['branch_id']) }}">
                                                      <button class="btn btn-primary">View Detail</button>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              <!-- Pagination Controls -->
                              {{-- <div class="pagination-controls mt-3">
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
                        </div> --}}
                          </div>
                          <div class="tab-pane fade" id="on-hold" role="tabpanel" aria-labelledby="on-hold-tab">
                              {{-- <h3>On Hold</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Merchant</th>
                                          <th>Branch Kecamatan</th>
                                          <th>Alamat Branch</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($DataOnHold as $item)
                                          <tr>
                                              <td>{{ $item['merchant'] }}</td>
                                              <td>{{ $item['branch_kecamatan'] }}</td>
                                              <td class="alamat-column">{{ $item['alamat_branch'] }}</td>
                                              <td>
                                                  <span
                                                      class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>
                                                  {{ $item['total_shipping_sameday'] }}</td>
                                              <td>
                                                  <a
                                                      href="{{ url('/sameday-on-hold-detail' . '/' . $item['branch_id']) }}">
                                                      <button class="btn btn-primary">View Detail</button>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane fade" id="on-pickup" role="tabpanel" aria-labelledby="on-pickup-tab">
                              {{-- <h3>On Pickup</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Merchant</th>
                                          <th>Branch Kecamatan</th>
                                          <th>Alamat Branch</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($DataOnPickup as $item)
                                          <tr>
                                              <td>{{ $item['merchant'] }}</td>
                                              <td>{{ $item['branch_kecamatan'] }}</td>
                                              <td class="alamat-column">{{ $item['alamat_branch'] }}</td>
                                              <td>
                                                  <span
                                                      class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>{{ $item['total_shipping_sameday'] }}</td>
                                              <td><button class="btn btn-primary"
                                                      wire:click="PickupDone({{ $item['branch_id'] }})">Pickup
                                                      Done</button></td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane fade" id="need-assigned" role="tabpanel"
                              aria-labelledby="need-assigned-tab">
                              {{-- <h3>Need Assigned</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Kecamatan</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($needAssigned as $item)
                                          <tr>
                                              <td>{{ $item['kecamatan'] }}</td>
                                              <td>
                                                  <span
                                                      class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>{{ $item['total_shipping_sameday'] }}</td>
                                              <td>
                                                  <a
                                                      href="{{ url('sameday-need-assigned-detail' . '/' . $item['kecamatanId']) }}">
                                                      <button class="btn btn-primary">View Detail</button>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane fade" id="on-delivery" role="tabpanel"
                              aria-labelledby="on-delivery-tab">
                              {{-- <h3>On Delivery</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Branch Kecamatan</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($DataOnDelivery as $item)
                                          <tr>
                                              <td>{{ $item['kecamatan'] }}</td>
                                              <td>
                                                  <span
                                                      class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>{{ $item['total_shipping_sameday'] }}</td>
                                              <td>
                                                  <a
                                                      href="{{ url('/sameday-on-delivery-detail' . '/' . $item['kecamatanId']) }}">
                                                      <button class="btn btn-primary">View Detail</button>
                                                  </a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                              {{-- <h3>Done</h3> --}}
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>Kecaamatan</th>
                                          <th>Status</th>
                                          <th>Total Shipping Sameday</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($DataDone as $item)
                                          <tr>
                                              <td>{{ $item['kecamatan'] }}</td>
                                              <td>
                                                  <span
                                                      class="badge bg-primary text-light">{{ $item['status'] }}</span>
                                              </td>
                                              <td>{{ $item['total_shipping_sameday'] }}</td>
                                          </tr>
                                      @empty
                                          <tr>
                                              <td>No Data</td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const navLinks = document.querySelectorAll('.nav-link');

          navLinks.forEach(link => {
              link.addEventListener('click', function(event) {
                  event.preventDefault(); // Prevent the default behavior
                  const href = this.getAttribute('href');
                  const id = this.id;

                  // Update the URL without reloading the page
                  history.pushState(null, '', '#' + id);

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
              });
          });

          // Handle browser navigation (back/forward) to activate the correct tab
          window.addEventListener('popstate', function() {
              const activeTabId = location.hash.substring(1);
              if (activeTabId) {
                  const activeLink = document.querySelector('.nav-link#' + activeTabId);
                  if (activeLink) {
                      activeLink.click();
                  }
              }
          });

          // Handle page load to activate the correct tab based on URL
          const activeTabId = location.hash.substring(1);
          if (activeTabId) {
              const activeLink = document.querySelector('.nav-link#' + activeTabId);
              if (activeLink) {
                  activeLink.click();
              }
          }
      });
  </script>
