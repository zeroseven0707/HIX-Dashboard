<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page - Aplikasi Ekspedisi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('fobia/css/style.css') }}" rel="stylesheet">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .container-fluid {
            height: 100vh;
            padding: 0;
        }

        .row-full {
            height: 100%;
        }

        .left-side {
            /* background-color: #7465E2; */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            height: 100%;
        }

        .right-side {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
            height: 100%;
        }

        .register-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .register-form h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .form-control {
            border-radius: 30px;
            padding-left: 40px;
        }

        .btn-register {
            border-radius: 30px;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: #321578;
            color: white;
        }

        .btn-register:hover{
            background-color: #1C0A56;

        }

        .form-icon {
            position: relative;
        }

        .form-icon i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #888;
        }

        .login {
            text-align: center;
            margin-top: 20px;
        }

        .login a {
            color: #5e53b0;
            /* font-weight: bold; */
        }
    </style>
    @livewireStyles
</head>

<body>
    <div class="container-fluid">
        <!--start sidebar -->
        @if (Request::is('login') || Request::is('registrasi'))
        @else
            @if (session('type') == 'cabang')
                @include('components.layouts.sidebar')
            @elseif (session('type') == 'merchant')
                @include('components.layouts.merchant_sidebar')
            @endif
        @endif
        <div class="row row-full">
            <!-- Right Side with Register Form -->
            <div class="col-md-6 right-side">
                <div class="register-form" style="max-width: 400px; margin: 0 auto; text-align: center;">
                    <div style="position: absolute; top: 20px; left: 30px;">
                        <img src="{{ asset('fobia/images/logo.png') }}" width="130px" alt="logo">
                    </div>
                    <h2 class="mt-3">Daftar Akun</h2>
                    <p class="text-center text-muted">Isi informasi di bawah untuk membuat akun baru.</p>
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                    @if (session('error'))
                        {{-- <div class="alert alert-danger">{{ session('error') }}</div> --}}
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: "{{ session('error') }}",
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                    <form action="{{ route('merchant.register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-control" placeholder="Username" id="username"
                                        name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" class="form-control" placeholder="Password" id="password"
                                        name="password" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-building"></i>
                                    <input type="text" class="form-control" placeholder="Nama Bisnis"
                                        id="bussinesName" name="bussinesName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-user-tie"></i>
                                    <input type="text" class="form-control" placeholder="Nama Pemilik Bisnis"
                                        id="bussinesOwener" name="bussinesOwener" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-phone"></i>
                                    <input type="text" class="form-control" placeholder="Nomor HP" id="nomorHp"
                                        name="nomorHp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-id-card"></i>
                                    <input type="text" class="form-control" placeholder="NIK" id="nik"
                                        name="nik" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-briefcase"></i>
                                    <select class="form-control" id="jenisUsahaId" name="jenisUsahaId" required>
                                        <option value="" disabled selected>Jenis Usaha</option>
                                        @foreach ($jenisUsaha as $jenis)
                                            <option value="{{ $jenis['id'] }}">{{ $jenis['jenisUsaha'] }}
                                                ({{ $jenis['singkatan'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-icon mb-3">
                                    <i class="fas fa-tags"></i>
                                    <select class="form-control" id="kategoriUsahaId" name="kategoriUsahaId" required>
                                        <option value="" disabled selected>Kategori Usaha</option>
                                        @foreach ($kategoriUsaha as $kategori)
                                            <option value="{{ $kategori['id'] }}">{{ $kategori['kategori'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn w-100 btn-register text-light">Daftar</button>
                    </form>
                    <div class="login mt-4">
                        <p>Sudah punya akun? <a href="/">Login di sini</a></p>
                    </div>
                </div>
            </div>
            <!-- Left Side with Visual -->
            <div class="col-md-6 left-side" style="background: linear-gradient(to right, #321578, #7a45f8);">
                <div class="text-light">
                    <img src="{{ asset('fobia/images/login.png') }}" width="450px" alt="">
                    <h2>HI Express</h2>
                    <p>Kemudahan dalam mengirimkan barang ke berbagai tujuan dengan tracking real-time.</p>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <footer class="footer">
        <div class="footer-text">
            Copyright © 2023. Hi Express
        </div>
    </footer>


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
