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
        {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> --}}

        <!-- Include Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!--Theme Styles-->
        <link href="{{ asset('fobia/css/dark-theme.css') }}" rel="stylesheet" />
        <link href="{{ asset('fobia/css/semi-dark.css') }}" rel="stylesheet" />
        <link href="{{ asset('fobia/css/header-colors.css') }}" rel="stylesheet" />
        <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script>

        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Bootstrap CSS -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        
        <!-- Bootstrap JS (including Popper.js for tooltips) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <title>HI Express</title>
        @livewireStyles
    </head>

    <body>
        <div class="wrapper">
            <!--start sidebar -->
            @if (Request::is('/') || Request::is('registrasi'))
            @else
                @if (session('type') == 'cabang')
                    @include('components.layouts.sidebar')
                @elseif (session('type') == 'merchant')
                    @include('components.layouts.merchant_sidebar')
                @endif
            @endif
            <!--end sidebar -->
            @if (Request::is('/') || Request::is('registrasi'))
            @else
                <header class="top-header">
                    <nav class="navbar navbar-expand gap-3">
                        <div class="toggle-icon">
                            <ion-icon name="menu-outline"></ion-icon>
                        </div>
                    </nav>
                </header>
                <!--start top header-->
                <!--end top header-->
            @endif
            <div>
                <!-- Modal HTML -->
                <div id="transactionModal" style="display: none;">
                    <div>
                        <h2>Transaction Details</h2>
                        <pre id="transactionDetails"></pre>
                        <button onclick="closeModal()">Close</button>
                    </div>
                </div>

                @if (Request::is('/'))
                    @livewire('login')
                @elseif (Request::is('dashboard'))
                    @livewire('dashboard')
                @elseif (Request::is('shipping-hold'))
                    @livewire('shipping-onhold')
                @elseif (Request::is('shipping-new'))
                    @livewire('new-shipping')
                @elseif (Request::is('shipping-on'))
                    @livewire('on-shipping')
                @elseif (Request::is('drivers'))
                    @livewire('driver')
                @elseif (Request::is('driver-registration'))
                    @livewire('driver-registration')
                @elseif (Request::is('finance'))
                    @livewire('finance')
                @elseif (Request::is('shipping-detail/*'))
                    @livewire('shipping-detail')
                @elseif (Request::is('shipping-request-detail/*'))
                    @livewire('shipping-request-detail')
                @elseif (Request::is('finance-merchant'))
                    @livewire('finance-merchant')
                @elseif (Request::is('dashboard-merchant'))
                    @livewire('dashboard-merchant')
                @elseif (Request::is('create-sameday'))
                    @livewire('sameday-create-shipping-intan')
                @elseif (Request::is('create-instan'))
                    @livewire('create-shipping-instan')
                @elseif (Request::is('deposit'))
                    @livewire('deposit')
                @elseif (Request::is('shipping-sameday'))
                    @livewire('same-day')
                @elseif (Request::is('sameday-request-detail/*'))
                    @php
                        $branchId = Request::segment(2); // Assume the branchId is in the second segment
                    @endphp
                    @livewire('same-day-request-detail', ['branchId' => $branchId])
                @elseif (Request::is('finance-merchant-detail/*'))
                    @php
                        $merchantId = Request::segment(2); // Anggap merchantId ada di segment kedua
                    @endphp
                    @livewire('finance-merchant-detail', ['merchantId' => $merchantId])
                @elseif (Request::is('sameday-on-hold-detail/*'))
                    @php
                        $branchId = Request::segment(2); // Assume the branchId is in the second segment
                    @endphp
                    @livewire('shipping-on-hold-detail', ['branchId' => $branchId])
                @elseif (Request::is('sameday-on-delivery-detail/*'))
                    @php
                        $kecamatanId = Request::segment(2); // Assume the branchId is in the second segment
                    @endphp
                    @livewire('same-day-on-delivery-detail', ['kecamatanId' => $kecamatanId])
                @elseif (Request::is('sameday-need-assigned-detail/*'))
                    @php
                        $kecamatanId = Request::segment(2); // Assume the branchId is in the second segment
                    @endphp
                    @livewire('need-assigned-detail', ['kecamatanId' => $kecamatanId])
                @elseif (Request::is('shipping-request-detail/*'))
                    @php
                        $noResi = Request::segment(2); // Assume the branchId is in the second segment
                    @endphp
                    @livewire('shipping-request-detail', ['noResi' => $noResi])
                @elseif (Request::is('merchant/paket-instan*'))
                    @livewire('merchant-get-all-paket-instan')
                @elseif (Request::is('merchant/paket-sameday'))
                    @livewire('merchant-get-all-paket-sameday')
                @elseif (Request::is('merchant/tracking'))
                    @livewire('merchant-tracking')
                @elseif (Request::is('merchant/list-cabang'))
                    @livewire('merchant-cabang')
                @elseif (Request::is('rekening'))
                    @livewire('rekening')
                @elseif (Request::is('komisi-driver'))
                    @livewire('driver-commission')
                @elseif (Request::is('ongkir'))
                    @livewire('ongkir')
                @elseif (Request::is('cashback'))
                    @livewire('cashback')
                @elseif (Request::is('logo'))
                    @livewire('logo')
                @elseif (Request::is('create-instant'))
                    @include('instant-create')
                @else
                @endif
            </div>
            <!--start footer-->
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
                    <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true"
                        data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <h6 class="mb-0">Theme Variation</h6>
                            <hr>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme"
                                    value="option1" checked>
                                <label class="form-check-label" for="LightTheme">Light</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme"
                                    value="option2">
                                <label class="form-check-label" for="DarkTheme">Dark</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDark"
                                    value="option3">
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

        <!-- Load socket.io from CDN -->
        <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
        <script>
            const apiKey = "{{ session('apiKey') }}";
        </script>
        <!-- Include compiled JavaScript -->
        <script src="{{ asset('js/socket.js') }}" defer></script>
        {{-- 
        <script>
            window.addEventListener('swal:modal', event => {
                swal({
                    title : event.detail.title,
                    text : event.detail.text,
                    type : event.detail.type
                });
            });
        </script> --}}

        {{-- <x-sweet-alert /> --}}
    </body>

    </html>
