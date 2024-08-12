
  <!-- start page content wrapper-->
  <div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
      <!--end breadcrumb-->
      <div class="row">
        <div class="row col-8 g-3 -ml-px">
            <div class="row col-12 p-2 border border-1 radius-10">
                @forelse ($data as $item)
                    <div class="col-4">
                    <div class="card radius-10">
                        <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                            <p class="mb-0 fs-6">{{ $item['Merchant']['bussinesName'] }}</p>
                            <small style="color: gray">{{ $item['Branch']['Kecamatan']['kecamatan'] }}</small>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-purple">
                            {{-- <ion-icon name="wallet-outline"></ion-icon> --}}
                            <img src="{{ asset('https://hixpress.online/'.$item['Merchant']['logo']) }}" width="25" alt="" srcset="">
                            </div>
                        </div>
                        <p>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</p>
                        <div class="d-flex align-items-center mt-3 gap-2">
                          <button class="btn btn-primary">{{ $item['Service']['service'] }}</button>
                          <button class="btn btn-success">{{ $item['paymentStatus'] }}</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    @empty
                    <div class="col-4">
                      <div class="card radius-10">
                          <div class="card-body">
                            <p class="text-center">No Data</p>
                          <div class="d-flex align-items-start gap-2">
                              <div>
                              </div>
                          </div>
                          <p></p>
                          <div class="d-flex align-items-center mt-3 gap-2">
                          </div>
                          </div>
                      </div>
                      </div>
                      <div class="col-4">
                        <div class="card radius-10">
                            <div class="card-body">
                              <p class="text-center">No Data</p>
                            <div class="d-flex align-items-start gap-2">
                                <div>
                                </div>
                            </div>
                            <p></p>
                            <div class="d-flex align-items-center mt-3 gap-2">
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-4">
                          <div class="card radius-10">
                              <div class="card-body">
                                <p class="text-center">No Data</p>
                              <div class="d-flex align-items-start gap-2">
                                  <div>
                                  </div>
                              </div>
                              <p></p>
                              <div class="d-flex align-items-center mt-3 gap-2">
                              </div>
                              </div>
                          </div>
                          </div>
                @endforelse
                <a href="/shipping-new">
                  <button class="btn w-100 btn-primary">View All</button>
                </a>
            </div>
            <div class="col-6">
              <div class="card radius-10 w-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-0">On Hold Shipping</h6>
                    <div class="dropdown options ms-auto">
                      <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <ion-icon name="ellipsis-horizontal-outline" class="md hydrated"></ion-icon>
                      </div>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="countries-list">
                    {{-- foreach --}}
                      @forelse ($onHold as $item)
                      <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="country-icon">
                        <img src="{{ asset('https://tedy-dev.my.id/'.$item['Merchant']['logo']) }}" width="35" alt="" srcset="">
                        </div>
                        <div class="country-name flex-grow-1">
                            <h5 class="mb-0">{{ $item['Merchant']['bussinesName'] }}</h5>
                            {{-- <p class="mb-0 text-secondary">United states</p> --}}
                        </div>
                        <div class="">
                            <p class="mb-0 text-danger d-flex gap-1 align-items-center fw-500"><span>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</span></p>
                        </div>
                        </div>
                        @empty
                        <div class="d-flex align-items-center gap-3 mb-3">
                          <div class="country-name flex-grow-1">
                              <h5 class="mb-0 text-center">no delivery</h5>
                          </div>
                          <div class="">
                          </div>
                          </div>
                      @endforelse
                    {{-- enforeach --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card radius-10 w-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-0">On Delivery</h6>
                    <div class="dropdown options ms-auto">
                      <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <ion-icon name="ellipsis-horizontal-outline" class="md hydrated"></ion-icon>
                      </div>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="countries-list">
                    @forelse ($DataOnDelivery as $item)
                        <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="country-icon">
                        <img src="{{ asset('https://tedy-dev.my.id/'.$item['Merchant']['logo']) }}" width="35" alt="" srcset="">
                        </div>
                        <div class="country-name flex-grow-1">
                            <h5 class="mb-0">{{ $item['Merchant']['bussinesName'] }}</h5>
                            {{-- <p class="mb-0 text-secondary">United states</p> --}}
                        </div>
                        <div class="">
                            <p class="mb-0 text-danger d-flex gap-1 align-items-center fw-500"><span>{{ \Carbon\Carbon::parse($item['tanggalRequest'])->format('d M Y H:i:s') }}</span></p>
                        </div>
                        </div>
                        @empty
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="country-name flex-grow-1">
                                <h5 class="mb-0 text-center">no delivery</h5>
                            </div>
                            <div class="">
                            </div>
                            </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h6 class="mb-0">Recent Shipping</h6>
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
                          @forelse ($recent as $item)
                              <tr>
                                  <td>{{ $item['Merchant']['bussinesName'] }}</td>
                                  <td><img src="{{ asset('https://tedy-dev.my.id/'.$item['Merchant']['logo']) }}" alt="Logo" width="50"></td>
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
        <div class="row col-4 g-2">
          <div class="col-12">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    <div class="card border shadow-none radius-10 mb-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                          <div class="country-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="40" height="40" rx="8" fill="#CEDEFF"/>
                              <path d="M20 30C19.182 30 18.4 29.675 16.837 29.026C12.946 27.41 11 26.602 11 25.243V15.745M20 30C20.818 30 21.6 29.675 23.163 29.026C27.054 27.41 29 26.602 29 25.243V15.745M20 30V20.169M11 15.745C11 16.348 11.802 16.73 13.405 17.492L16.325 18.882C18.13 19.74 19.03 20.17 20 20.17C20.97 20.17 21.87 19.74 23.675 18.882L26.595 17.492C28.198 16.73 29 16.348 29 15.745M11 15.745C11 15.141 11.802 14.759 13.405 13.997L15.5 13M29 15.745C29 15.141 28.198 14.76 26.595 13.998L24.5 13M14 21.152L16 22.135M20.004 10V17M20.004 17C20.267 17.004 20.526 16.82 20.718 16.595L22 15.062M20.004 17C19.75 16.997 19.493 16.814 19.29 16.595L18 15.062" stroke="#165EF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>                              
                          </div>
                          <div class="country-name flex-grow-1">
                              <h5 class="mb-0">New Request</h5>
                              <p class="mb-0 text-secondary">New Shipping Request</p>
                          </div>
                          <div class="">
                              <p class="mb-0 text-success d-flex gap-1 align-items-center fw-500"><span>
                                <a href="/shipping-on#new">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                </a>
                                </span></p>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="card border shadow-none radius-10 mb-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                          <div class="country-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="40" height="40.0001" rx="8" fill="#FFFACE"/>
                              <path d="M20 30.0001C19.182 30.0001 18.4 29.6701 16.837 29.0121C12.946 27.3731 11 26.5541 11 25.1751V15.5421M20 30.0001C20.818 30.0001 21.6 29.6701 23.163 29.0121C27.054 27.3731 29 26.5541 29 25.1751V15.5421M20 30.0001V20.0301C20.97 20.0301 21.871 19.5951 23.675 18.7251L26.595 17.3151C28.198 16.5421 29 16.1551 29 15.5421M11 15.5421C11 16.1551 11.802 16.5411 13.405 17.3141L16.325 18.7241C18.129 19.5941 19.03 20.0281 20 20.0281M11 15.5421C11 14.9301 11.802 14.5431 13.405 13.7701L15 13.0001M29 15.5421C29 14.9301 28.198 14.5431 26.595 13.7701L25.045 13.0221M14 21.0261L16 22.0231M19.996 17.0001V10.0001M19.996 10.0001C19.733 9.99606 19.474 10.1801 19.282 10.4051L18 11.9381M19.996 10.0001C20.25 10.0031 20.507 10.1861 20.71 10.4051L22 11.9381" stroke="#FFE500" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                              
                          </div>
                          <div class="country-name flex-grow-1">
                              <h5 class="mb-0">On Pickup</h5>
                              <p class="mb-0 text-secondary">Driver On Pickup</p>
                          </div>
                          <div class="">
                              <p class="mb-0 text-success d-flex gap-1 align-items-center fw-500"><span>
                                <a href="/shipping-on#pickup">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                </a>
                                </span></p>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="card border shadow-none radius-10 mb-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                          <div class="country-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="40" height="40" rx="8" fill="#F2CEFF"/>
                              <path d="M21 30C20.182 30 19.4 29.659 17.837 28.976C16.012 28.18 14.616 27.57 13.647 27H10M21 30C21.818 30 22.6 29.659 24.163 28.976C28.054 27.278 30 26.43 30 25V14.5M21 30V19M12 14.5V17.5" stroke="#BD00FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M26.137 12.016L15.867 16.985M10 21H13M10 24H13M17.326 17.691L14.405 16.278C12.802 15.502 12 15.114 12 14.5C12 13.886 12.802 13.498 14.405 12.722L17.325 11.309C19.13 10.436 20.03 10 21 10C21.97 10 22.871 10.436 24.674 11.309L27.595 12.722C29.198 13.498 30 13.886 30 14.5C30 15.114 29.198 15.502 27.595 16.278L24.675 17.691C22.87 18.564 21.97 19 21 19C20.03 19 19.129 18.564 17.326 17.691Z" stroke="#BD00FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                              
                          </div>
                          <div class="country-name flex-grow-1">
                              <h5 class="mb-0">On Delivery</h5>
                              <p class="mb-0 text-secondary">Driver On Delivery</p>
                          </div>
                          <div class="">
                              <p class="mb-0 text-success d-flex gap-1 align-items-center fw-500"><span>
                                <a href="/shipping-on#delivery">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                </a>
                                </span></p>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="card border shadow-none radius-10 mb-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                          <div class="country-icon">
                            <svg width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="39" height="40" rx="8" fill="#D8FFCE"/>
                              <path d="M28 15V20M10 15V25.161C10 26.544 11.946 27.366 15.837 29.009C17.4 29.67 18.182 30 19 30V19.355M22 27C22 27 22.875 27 23.75 29C23.75 29 26.53 24 29 23" stroke="#33FF00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M13 20L15 21M24 12L14 17M15.326 17.691L12.405 16.278C10.802 15.502 10 15.114 10 14.5C10 13.886 10.802 13.498 12.405 12.722L15.325 11.309C17.13 10.436 18.03 10 19 10C19.97 10 20.871 10.436 22.674 11.309L25.595 12.722C27.198 13.498 28 13.886 28 14.5C28 15.114 27.198 15.502 25.595 16.278L22.675 17.691C20.87 18.564 19.97 19 19 19C18.03 19 17.129 18.564 15.326 17.691Z" stroke="#33FF00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                              
                          </div>
                          <div class="country-name flex-grow-1">
                              <h5 class="mb-0">Shipping Done</h5>
                              <p class="mb-0 text-secondary">Shipping Received</p>
                          </div>
                          <div class="">
                              <p class="mb-0 text-success d-flex gap-1 align-items-center fw-500"><span>
                                <a href="/shipping-on#done">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 12C2.5 7.522 2.5 5.282 3.891 3.891C5.282 2.5 7.521 2.5 12 2.5C16.478 2.5 18.718 2.5 20.109 3.891C21.5 5.282 21.5 7.521 21.5 12C21.5 16.478 21.5 18.718 20.109 20.109C18.718 21.5 16.479 21.5 12 21.5C7.522 21.5 5.282 21.5 3.891 20.109C2.5 18.718 2.5 16.479 2.5 12Z" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 7C10 7 14 10.682 14 12C14 13.318 10 17 10 17" stroke="#373737" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                </a>
                                </span></p>
                          </div>
                          </div>
                      </div>
                    </div>
                </div>
                </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                  <div class="d-flex align-items-start gap-2">
                      <div>
                          <h5 class="mb-0 ">Driver</h5>
                      </div>
                      <div class="ms-auto widget-icon-2 text-white bg-info rounded-circle">
                          <ion-icon name="people-outline"></ion-icon>
                      </div>
                  </div>
                  <div>
                    @forelse ($driver as $item)
                    <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="country-icon">
                      {{--  --}}
                    </div>
                    <div class="country-name flex-grow-1">
                        <h5 class="mb-0">{{ $item['fullName'] }}</h5>
                        <p class="mb-0 text-secondary">{{ $item['UnitKendaraan']['unitKendaraan'] }}</p>
                    </div>
                    <div class="">
                        <p class="mb-0 d-flex gap-1 align-items-center fw-500 {{ ($item['keterangan'] == "Active")?"text-primary":"text-danger" }}"><span>{{ $item['keterangan'] }}</span></p>
                    </div>
                    </div>
                    @empty
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="country-name flex-grow-1">
                            <h5 class="mb-0 text-center">no data</h5>
                        </div>
                        <div class="">
                        </div>
                        </div>
                @endforelse
                  </div>
              <a href="/drivers"><button class="btn btn-primary w-100">View All</button></a>    
              </div>
             
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
    <!-- end page content-->
  </div>
  <!--end page content wrapper-->


