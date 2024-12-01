<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container">
            <h2>Driver Registration</h2>

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
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: "{{ session('error') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif
            <form wire:submit.prevent="registerDriver">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Data Diri</h5>
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" id="nik" wire:model="nik" class="form-control">
                                            @error('nik')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name</label>
                                            <input type="text" id="fullname" wire:model="fullname"
                                                class="form-control">
                                            @error('fullname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="text" id="contact" wire:model="contact"
                                                class="form-control">
                                            @error('contact')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Address</label>
                                            <input type="text" id="alamat" wire:model="alamat"
                                                class="form-control">
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="provinsi">Provinsi</label>
                                            <select id="provinsi" wire:model="provinsiId" class="form-control"
                                                wire:change="loadKabupaten">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($province as $prov)
                                                    <option value="{{ $prov['id'] }}">{{ $prov['provinsi'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if (!empty($kabupaten))
                                            <div>
                                                <label for="kabupaten">Kabupaten</label>
                                                <select id="kabupaten" class="form-control" wire:model="kabupatenId"
                                                    wire:change="loadKecamatan">
                                                    <option value="">Pilih Kabupaten</option>
                                                    @foreach ($kabupaten as $kab)
                                                        <option value="{{ $kab['id'] }}">{{ $kab['kabupaten'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        @if (!empty($kecamatan))
                                            <div>
                                                <label for="kecamatan">Kecamatan</label>
                                                <select id="kecamatan" class="form-control" wire:model="kecamatanId">
                                                    <option value="">Pilih Kecamatan</option>
                                                    @foreach ($kecamatan as $kec)
                                                        <option value="{{ $kec['id'] }}">{{ $kec['kecamatan'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="kelurahan" class="form-label">Sub-district</label>
                                            <input type="text" id="kelurahan" wire:model="kelurahan"
                                                class="form-control">
                                            @error('kelurahan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="unitKendaraanId">unitKendaraan</label>
                                            <select id="unitKendaraanId" wire:model="unitKendaraanId"
                                                class="form-control">
                                                <option value="">Pilih unitKendaraan</option>
                                                @foreach ($unitKendaraan as $uk)
                                                    <option value="{{ $uk['id'] }}">{{ $uk['unitKendaraan'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Data Akun</h5>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" id="username" wire:model="username"
                                                class="form-control">
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" wire:model="password"
                                                class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="div">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', ()=> {
        @this.on('swal', (event)=>{
            const data=event
            swal.fire({
                icon:data[0]['icon'],
                title:data[0]['title'],
                text:data[0]['text']
            })
        })
    })
</script>
