<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Merchant</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-header {
            position: relative;
            background-color: #599be2;
            color: #fff;
            padding: 3rem 0;
            text-align: center;
        }

        .profile-header .img-container {
            width: 150px;
            height: 150px;
            border: 5px solid #fff;
            border-radius: 50%;
            overflow: hidden;
            /* Penting agar gambar tidak keluar dari kontainer */
            margin: 0 auto;
        }

        .profile-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Memastikan gambar tetap proporsional dalam kontainer */
        }

        .edit-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 0.5rem;
            color: #fff;
            cursor: pointer;
        }

        .profile-info {
            margin-top: -5rem;
        }

        .profile-info .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="profile-header">
        <div class="position-relative d-inline-block img-container">
            <img src="{{ env('API_BASE_URL_ORIGIN') . $profile['logo'] }}" alt="Logo" class="img-fluid">
            <a href="/logo" class="edit-icon"><i class="fas fa-edit"></i></a>
        </div>
        <h1>{{ $profile['username'] }}</h1>
        <p>{{ $profile['bussinesName'] }}</p>
    </div>

    <div class="container profile-info">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Nama Pemilik Usaha</th>
                                    <td>{{ $profile['bussinesOwener'] }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor HP</th>
                                    <td>{{ $profile['nomorHp'] }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $profile['nik'] }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Usaha</th>
                                    <td>{{ $profile['JenisUsaha']['jenisUsaha'] }}
                                        ({{ $profile['JenisUsaha']['singkatan'] }})</td>
                                </tr>
                                <tr>
                                    <th>Kategori Usaha</th>
                                    <td>{{ $profile['KategoriUsaha']['kategori'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <div class="">
                                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
