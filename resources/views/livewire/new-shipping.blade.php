  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
    <div class="card radius-10 w-100">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">New Shipping</h6>
            <div class="fs-5 ms-auto dropdown">
              <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                  class="bi bi-three-dots"></i></div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
          </div>
          <div class="table-responsive mt-2">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Business Name</th>
                        <th>Logo</th>
                        <th>No Resi</th>
                        <th>Status</th>
                        <th>Service</th>
                        <th>Payment Status</th>
                        <th>Tanggal Request</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item['Merchant']['bussinesName'] }}</td>
                            <td><img src="{{ asset(env('API_BASE_URL_ORIGIN').$item['Merchant']['logo']) }}" alt="Logo" width="50"></td>
                            <td>{{ $item['noResi'] }}</td>
                            <td>{{ $item['status'] }}</td>
                            <td>{{ $item['Service']['service'] }}</td>
                            <td>{{ $item['paymentStatus'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</td>
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
    </div>
</div>
</div>