  <!-- start page content wrapper-->
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <!-- loader-->
      <link href="{{ asset('fobia/css/pace.min.css') }}" rel="stylesheet" />
      <script src="{{ asset('fobia/js/pace.min.js') }}"></script>

      <!--plugins-->
      <link href="{{ asset('fobia/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
      <link href="{{ asset('fobia/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
      <link href="{{ asset('fobia/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

      <!-- CSS Files -->
      <link href="{{ asset('fobia/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('fobia/css/bootstrap-extended.css') }}" rel="stylesheet">
      <link href="{{ asset('fobia/css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('fobia/css/icons.css') }}" rel="stylesheet">
      {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> --}}

      <!-- Include Font Awesome -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <!--Theme Styles-->
      <link href="{{ asset('fobia/css/dark-theme.css') }}" rel="stylesheet" />
      <link href="{{ asset('fobia/css/semi-dark.css') }}" rel="stylesheet" />
      <link href="{{ asset('fobia/css/header-colors.css') }}" rel="stylesheet" />
      <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
      <div class="page-content-wrapper">
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

              @if ($shippingDetail)
                  <div class="container mt-5">
                      <div class="card">
                          <div class="card-body shadow">
                              <div class="d-flex justify-content-between">
                                  <h5><Strong>Assign Driver For Shipping</Strong></h5>
                                  <a href="/shipping-on"> <button class="btn btn-outline-secondary btn-sm"><i
                                              class="fas fa-arrow-left"></i> Kembali</button></a>
                              </div>

                              <div class="row mt-3">
                                  <div class="col col-md-8">
                                      <div class="row">
                                          <div class="col-md-6 mb-2">
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
                                          <div class="col-md-6 mb-2">
                                              <!-- Detail Informasi -->
                                              <h6><i class="fas fa-box"></i> Detail Informasi</h6>
                                              <button class="btn btn-light text-primary w-100 mb-2 text-start">No
                                                  Resi<br>{{ $shippingDetail['noResi'] }}</button>
                                              <button
                                                  class="btn btn-danger text-light w-100 mb-2">{{ $shippingDetail['status'] }}</button>
                                              <button
                                                  class="btn btn-info text-light w-100">{{ $shippingDetail['Service']['service'] }}</button>
                                          </div>
                                          <div class="col-md-6 mb-2">
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
                                              <!-- Pengirim -->
                                              <div class="">
                                                  <button class="btn btn-primary btn-sm mb-2"><i
                                                          class="fas fa-building"></i>
                                                      {{ $shippingDetail['Merchant']['bussinesName'] }}</button>
                                                  <div class="card">
                                                      <div class="card-body">
                                                          <h6>Alamat</h6>
                                                          <p>{{ $shippingDetail['Branch']['alamat'] }}
                                                          </p>
                                                      </div>
                                                  </div>
                                              </div>

                                              <!-- Penerima -->
                                              <div class="">
                                                  <button class="btn btn-primary btn-sm mb-2"><i
                                                          class="fas fa-home"></i>
                                                      {{ $shippingDetail['namaPenerima'] }}</button>
                                                  <div class="card">
                                                      <div class="card-body">
                                                          <h6>Alamat</h6>
                                                          <p>{{ $shippingDetail['alamatPenerima'] }}
                                                          </p>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col col-md-4">
                                      <div class="row">
                                          <div class="col col-md-12 mb-2">
                                              <!-- Shipping Logs -->
                                              <h6><i class="fas fa-history"></i> Shipping Logs</h6>
                                              <div class="card">
                                                  <div class="card-body">
                                                      <ul class="list-group timeline mb-3">
                                                          @foreach ($shippingDetail['logs'] as $log)
                                                              <li class="list-group-item">
                                                                  <span class="text-muted">{{ $log['tanggal'] }}
                                                                      {{ date('H:i', strtotime($log['jam'])) }}</span>
                                                                  -
                                                                  {{ $log['keterangan'] }}
                                                              </li>
                                                          @endforeach
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col col-md-12 mb-2">
                                              <h6><i class="fas fa-users"></i> Driver For Pickup</h6>
                                              <div class="card">
                                                  <div class="card-body">
                                                      <table class="table bg-light border=0">
                                                          <thead>
                                                              <tr>
                                                                  <th class="text-start">Driver Name</th>
                                                                  <th class="">Action</th>
                                                              </tr>
                                                          </thead>
                                                          @foreach ($drivers as $item)
                                                              <tbody>
                                                                  <tr>
                                                                      <td class="text-start">{{ $item['fullName'] }}
                                                                      </td>
                                                                      {{-- <td class="text-end>
                                                                        <a href="{{ url('/shipping-assign-driver' . '/' . $noResi . '/' . $item['id']) }}"><button
                                                                                class="btn btn-primary">Assign</button></a>
                                                                    </td> --}}
                                                                      <td class="text-end">
                                                                          <a
                                                                              href="{{ url('/shipping-assign-driver' . '/' . $noResi . '/' . $item['id']) }}"><button
                                                                                  class="btn btn-primary">Assign</button></a>
                                                                      </td>

                                                                  </tr>
                                                              </tbody>
                                                          @endforeach
                                                      </table>
                                                      <!-- Pagination Links -->
                                                      @if ($pagination)
                                                          <div class="d-flex justify-content-center">
                                                              <nav aria-label="Page navigation example">
                                                                  <ul class="pagination">
                                                                      <!-- Previous Page Link -->
                                                                      @if ($pagination['page'] > 1)
                                                                          <li class="page-item">
                                                                              <a class="page-link"
                                                                                  href="?page={{ $pagination['page'] - 1 }}"
                                                                                  aria-label="Previous">
                                                                                  <span
                                                                                      aria-hidden="true">&laquo;</span>
                                                                              </a>
                                                                          </li>
                                                                      @endif

                                                                      <!-- Page Numbers -->
                                                                      @for ($i = 1; $i <= $pagination['lastPage']; $i++)
                                                                          <li
                                                                              class="page-item {{ $i == $pagination['page'] ? 'active' : '' }}">
                                                                              <a class="page-link"
                                                                                  href="?page={{ $i }}">{{ $i }}</a>
                                                                          </li>
                                                                      @endfor

                                                                      <!-- Next Page Link -->
                                                                      @if ($pagination['page'] < $pagination['lastPage'])
                                                                          <li class="page-item">
                                                                              <a class="page-link"
                                                                                  href="?page={{ $pagination['page'] + 1 }}"
                                                                                  aria-label="Next">
                                                                                  <span
                                                                                      aria-hidden="true">&raquo;</span>
                                                                              </a>
                                                                          </li>
                                                                      @endif
                                                                  </ul>
                                                              </nav>
                                                          </div>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @else
                  <p class="text-center">Loading...</p>
              @endif

          </div>

      </div><!-- start page content-->
  </body>

  </html>
