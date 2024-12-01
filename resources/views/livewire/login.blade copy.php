  <div class="wrapper">
      <div class="row g-0 m-0">
        <div class="col-xl-6 col-lg-12">
          <div class="login-cover-wrapper">
            <div class="card shadow-none">
              <div class="card-body">
                <div class="">
                  <img src="{{ asset('fobia/images/logo.svg') }}" alt="logo">
                </div>
                <div class="text-center">
                  <h4>Sign In</h4>
                  <p>Sign In to your account</p>
                </div>
                <form class="form-body row g-3" wire:submit.prevent="login">
                  <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" wire:model="username" class="form-control">
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control">
                  </div>
                  {{-- <div class="col-12 col-lg-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRemember">
                      <label class="form-check-label" for="flexSwitchCheckRemember">Remember Me</label>
                    </div>
                  </div> --}}
                  <div class="col-12 col-lg-6 text-end">
                    {{-- <a href="authentication-reset-password-cover.html">Forgot Password?</a> --}}
                  </div>
                  <div class="col-12 col-lg-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </div>
                  <div class="col-12 col-lg-12 text-center">
                    <p class="mb-0">Don't have an account? <a href="/registrasi">Sign up</a></p>
                    @if ($responseMessage)
                      <p class="text-danger">{{ $responseMessage }}</p>
                    @endif
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12">
          <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
            {{-- <img src="{{ asset('fobia/images/login.png') }}" width="750" alt="" srcset=""> --}}
          </div>
        </div>
      </div>
  </div>
  <!--end wrapper-->