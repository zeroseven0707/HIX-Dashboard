<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <!--Theme Styles-->
  <link href="{{ asset('fobia/css/dark-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('fobia/css/semi-dark.css') }}" rel="stylesheet" />
  <link href="{{ asset('fobia/css/header-colors.css') }}" rel="stylesheet" />
  <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script>
  <title>Fobia - Bootstrap5 Admin Template</title>
  @livewireStyles
</head>
<body>
<div class="wrapper">
      <!--start sidebar -->
    @if (Request::is('login') || Request::is('registrasi'))
    @else
    @if (session('type') == 'cabang')
      @include('components.layouts.sidebar')
    @elseif (session('type') == 'merchant')
      @include('components.layouts.merchant_sidebar')
    @endif
    @endif
  <!--end sidebar -->

  <!--start top header-->
  <header class="top-header">
    <nav class="navbar navbar-expand gap-3">
      <div class="toggle-icon">
        <ion-icon name="menu-outline"></ion-icon>
      </div>
    </nav>
  </header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="row g-0 m-0">
                <div class="col-xl-6 col-lg-12">
                  <div class="login-cover-wrapper">
                    <div class="card shadow-none">
                      <div class="card-body">
                        <div class="text-center">
                          <h4>Sign Up</h4>
                          <p>Sign Up to your account</p>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('merchant.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="bussinesName">Nama Bisnis</label>
                            <input type="text" class="form-control" id="bussinesName" name="bussinesName" required>
                        </div>
                        <div class="form-group">
                            <label for="bussinesOwener">Nama Pemilik Bisnis</label>
                            <input type="text" class="form-control" id="bussinesOwener" name="bussinesOwener" required>
                        </div>
                        <div class="form-group">
                            <label for="nomorHp">Nomor HP</label>
                            <input type="text" class="form-control" id="nomorHp" name="nomorHp" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label for="jenisUsahaId">Jenis Usaha</label>
                            <select class="form-control" id="jenisUsahaId" name="jenisUsahaId" required>
                                @foreach($jenisUsaha as $jenis)
                                    <option value="{{ $jenis['id'] }}">{{ $jenis['jenisUsaha'] }} ({{ $jenis['singkatan'] }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategoriUsahaId">Kategori Usaha</label>
                            <select class="form-control" id="kategoriUsahaId" name="kategoriUsahaId" required>
                                @foreach($kategoriUsaha as $kategori)
                                    <option value="{{ $kategori['id'] }}">{{ $kategori['kategori'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Daftar</button>
                    </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                  <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
                    <img src="{{ asset('fobia/images/login.png') }}" alt="" srcset="">
                  </div>
                </div>
              </div>
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Registrasi Merchant</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('merchant.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="bussinesName">Nama Bisnis</label>
                                <input type="text" class="form-control" id="bussinesName" name="bussinesName" required>
                            </div>
                            <div class="form-group">
                                <label for="bussinesOwener">Nama Pemilik Bisnis</label>
                                <input type="text" class="form-control" id="bussinesOwener" name="bussinesOwener" required>
                            </div>
                            <div class="form-group">
                                <label for="nomorHp">Nomor HP</label>
                                <input type="text" class="form-control" id="nomorHp" name="nomorHp" required>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                            <div class="form-group">
                                <label for="jenisUsahaId">Jenis Usaha</label>
                                <select class="form-control" id="jenisUsahaId" name="jenisUsahaId" required>
                                    @foreach($jenisUsaha as $jenis)
                                        <option value="{{ $jenis['id'] }}">{{ $jenis['jenisUsaha'] }} ({{ $jenis['singkatan'] }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategoriUsahaId">Kategori Usaha</label>
                                <select class="form-control" id="kategoriUsahaId" name="kategoriUsahaId" required>
                                    @foreach($kategoriUsaha as $kategori)
                                        <option value="{{ $kategori['id'] }}">{{ $kategori['kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <footer class="footer-wraped">@include('components.layouts.footer')
        <!--end footer-->
      
      
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
          <ion-icon name="arrow-up-outline"></ion-icon>
        </a>
        <!--End Back To Top Button-->
      
        <!--start switcher-->
        <div class="switcher-body">
          <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <ion-icon name="color-palette-outline" class="me-0"></ion-icon>
          </button>
          <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false"
            tabindex="-1" id="offcanvasScrolling">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
              <h6 class="mb-0">Theme Variation</h6>
              <hr>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1" checked>
                <label class="form-check-label" for="LightTheme">Light</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
                <label class="form-check-label" for="DarkTheme">Dark</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDark" value="option3">
                <label class="form-check-label" for="SemiDark">Semi Dark</label>
              </div>
              <hr />
              <h6 class="mb-0">Header Colors</h6>
              <hr />
              <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                  <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                  </div>
                  <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                  </div>
                </div>
              </div>
      
            </div>
          </div>
        </div>
        <!--end switcher-->
      
      
        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->
      </div>
      @livewireScripts
      
        <!-- JS Files-->
        <script src="{{ asset('fobia/js/jquery.min.js') }}"></script>
        <script src="{{ asset('fobia/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('fobia/plugins/metismenu/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('fobia/js/bootstrap.bundle.min.js') }}"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <!--plugins-->
        <script src="{{ asset('fobia/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('fobia/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('fobia/plugins/easyPieChart/jquery.easypiechart.js') }}"></script>
        <script src="{{ asset('fobia/plugins/chartjs/chart.min.js') }}"></script>
        <script src="{{ asset('fobia/js/index.js') }}"></script>
        <!-- Main JS-->
        <script src="{{ asset('fobia/js/main.js') }}"></script>
        {{-- <script>
          document.addEventListener('DOMContentLoaded', function () {
              // Ambil API key dari Laravel session
              const apiKey = '{{ session("apiKey") }}';
              const wsUrl = 'wss://tedy-dev.my.id';
      
              // Buat koneksi WebSocket
              const socket = new WebSocket(wsUrl);
      
              socket.onopen = function () {
                  console.log('WebSocket connection established.');
      
                  // Kirim API key untuk autentikasi
                  socket.send(JSON.stringify({ type: 'authenticate', apiKey: apiKey }));
              };
      
              socket.onmessage = function (event) {
                  try {
                      const data = JSON.parse(event.data);
      
                      if (data.event === 'transactionCreated') {
                          showModal(data.transaction);
                      }
                  } catch (error) {
                      console.error('Error parsing WebSocket message:', error);
                  }
              };
      
              socket.onclose = function () {
                  console.log('WebSocket connection closed.');
              };
      
              socket.onerror = function (error) {
                  console.error('WebSocket error:', error);
              };
      
              function showModal(transaction) {
                  document.getElementById('transactionDetails').innerText = JSON.stringify(transaction, null, 2);
                  document.getElementById('transactionModal').style.display = 'block';
              }
      
              function closeModal() {
                  document.getElementById('transactionModal').style.display = 'none';
              }
          });
      </script> --}}
   <!-- Load SweetAlert2 from CDN -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Load socket.io from CDN -->
   <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
   <script>
    const apiKey = "{{ session('apiKey') }}";
  </script>
   <!-- Include compiled JavaScript -->
   <script src="{{ asset('js/socket.js') }}" defer></script>
      
      </body>
      
      </html>
      