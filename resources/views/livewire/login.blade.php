<div class="wrapper">
    <div class="container-fluid" style="height: 100vh; padding:0">
        <div class="row row-full" style="height: 100%">
            <!-- Left Side with Visual -->
            <!-- Right Side with Login Form -->
            <div class="col-md-6 right-side"
                style="padding: 40px; display: flex; flex-direction: column; justify-content: center; background-color: white; height: 100%;">
                <div class="login-form" style="max-width: 400px; margin: 0 auto; text-align: center;">
                    <!-- Logo Section in Top Right Corner -->
                    <div style="position: absolute; top: 20px; left: 30px;">
                        <img src="{{ asset('fobia/images/logo.png') }}" width="130px" alt="logo">
                    </div>

                    <h3 class="mt-3" style="margin-bottom: 20px; font-weight: bold; color: #333; text-align: center;">
                        Hello Again
                    </h3>
                    <p class="text-center text-muted">Masukkan informasi login Anda untuk melanjutkan menggunakan
                        layanan kami.</p>
                    <form wire:submit.prevent="login" class="">
                        <div class="form-group form-icon mb-3" style="position: relative;">
                            <i class="fas fa-user" style="position: absolute; top: 12px; left: 12px; color: #888;"></i>
                            <input type="text" wire:model="username" id="username" class="form-control"
                                placeholder="Username" required style="border-radius: 30px; padding-left: 40px;">
                        </div>
                        <div class="form-group form-icon mb-3" style="position: relative;">
                            <i class="fas fa-lock" style="position: absolute; top: 12px; left: 12px; color: #888;"></i>
                            <input type="password" id="password" wire:model="password" class="form-control"
                                placeholder="Password" required style="border-radius: 30px; padding-left: 40px;">
                        </div>
                        <button type="submit" class="btn btn w-100 btn-primary text-light"
                            style="border-radius: 30px; padding: 10px; font-size: 16px; font-weight: bold; ">Login</button>
                            {{-- <button class="btn btn-success" wire:click="save" >save</button> --}}
                    </form>
                    <div class="register mt-4">
                        <p>Belum punya akun? <a href="/registrasi">Daftar di sini</a></p>
                    </div>
                    @if ($responseMessage)
                        <p class="text-danger">{{ $responseMessage }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6 left-side"
                style="background: linear-gradient(to right, #321578, #7a45f8); display: flex; justify-content: center; align-items: center; color: white; text-align: center; padding: 20px; height: 100%;">
                <div class="text-light">
                    <img src="{{ asset('fobia/images/login.png') }}" width="400px" alt="">
                    <h2><strong>HI EXPRESS</strong></h2>
                    <p>Kemudahan dalam mengirimkan barang ke berbagai tujuan dengan tracking real-time.</p>
                </div>
            </div>

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
<!--end wrapper-->
