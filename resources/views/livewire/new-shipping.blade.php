  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
    <div class="card shadow radius-10 w-100">
      <div class="card-header">
        <div class="card-title">
          <h6 class="mb-0">New Shipping</h6>
        </div>
      </div>
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="fs-5 ms-auto dropdown">
              {{-- <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                  class="bi bi-three-dots"></i></div> --}}
              {{-- <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul> --}}
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-stripped">
                    <tr>
                        <th>Business Name</th>
                        <th>Logo</th>
                        <th>No Resi</th>
                        <th>Status</th>
                        <th>Service</th>
                        <th>Payment Status</th>
                        <th>Tanggal Request</th>
                        <th>Jam Request</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item['Merchant']['bussinesName'] }}</td>
                            <td>
                              <div class="country-icon2">
                                <img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50">
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center bg-light">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
</div>