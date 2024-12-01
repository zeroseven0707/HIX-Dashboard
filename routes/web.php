<?php

use App\Http\Controllers\BranchDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstanCreateShippingController;
use App\Http\Controllers\InstanDetailController;
use App\Http\Controllers\MerchantCabangController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\RegistrasiMerchantControler;
use App\Http\Controllers\SamedayCreateShippingController;
use App\Http\Controllers\SamedayDetailController;
use App\Http\Controllers\ShippingRequestDetailController;
use App\Http\Controllers\SSEController;
use App\Livewire\AssignRequestInstan;
use App\Livewire\Cashback;
use App\Livewire\CreateShippingInstan;
use App\Livewire\Dashboard;
use App\Livewire\DashboardMerchant;
use App\Livewire\Deposit;
use App\Livewire\Driver;
use App\Livewire\DriverCommission;
use App\Livewire\DriverRegistration;
use App\Livewire\Finance;
use App\Livewire\FinanceMerchant;
use App\Livewire\FinanceMerchantDetail;
use App\Livewire\Login;
use App\Livewire\Logo;
use App\Livewire\MerchantCabang;
use App\Livewire\MerchantGetAllPaketInstan;
use App\Livewire\MerchantGetAllPaketSameday;
use App\Livewire\MerchantPaketInstanDetail;
use App\Livewire\MerchantPaketSamedayDetail;
use App\Livewire\MerchantTracking;
use App\Livewire\NeedAssignedDetail;
use App\Livewire\NewShipping;
use App\Livewire\Ongkir;
use App\Livewire\OnShipping;
use App\Livewire\Rekening;
use App\Livewire\SameDay;
use App\Livewire\SamedayCreateShippingIntan;
use App\Livewire\SameDayOnDeliveryDetail;
use App\Livewire\SameDayOnDoneDetail;
use App\Livewire\SameDayRequestDetail;
use App\Livewire\ShippingDetail;
use App\Livewire\ShippingOnHold;
use App\Livewire\ShippingOnHoldDetail;
use App\Livewire\ShippingRequestDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::middleware('login')->group(function () {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');
  Route::get('/dashboard-merchant', DashboardMerchant::class)->name('dashboard.merchant');
  Route::get('/shipping-hold', ShippingOnHold::class)->name('shipping-onhold');
  Route::get('/shipping-new', NewShipping::class)->name('shipping-new');
  Route::get('/shipping-on', OnShipping::class)->name('shipping-on');
  Route::get('/shipping-sameday', SameDay::class)->name('shipping-sameday ');
  Route::get('/shipping-detail/{noResi}', ShippingDetail::class)->name('shipping-detail');
  Route::get('/shipping-request-detail/{noResi}', [ShippingRequestDetailController::class, 'index']);
  Route::get('/shipping-assign-driver/{noResi}/{driverId}', [ShippingRequestDetailController::class, 'assignDriver'])->name('shipping-request-detail');
  Route::get('/drivers', Driver::class)->name('drivers');
  Route::get('/finance', Finance::class)->name('finance');
  Route::get('/finance-merchant', FinanceMerchant::class)->name('finance.merchant');
  Route::get('/finance-merchant-detail/{merchantId}', FinanceMerchantDetail::class)->name('finance.merchant');
  Route::get('/deposit', Deposit::class)->name('deposit');
  Route::get('/driver-registration', DriverRegistration::class);
  Route::get('/sameday-on-hold-detail/{branchId}', ShippingOnHoldDetail::class);
  Route::get('/sameday-request-detail/{branchId}', SameDayRequestDetail::class)->name('sameday.request.detail');
  Route::get('/sameday-need-assigned-detail/{kecamatanId}', NeedAssignedDetail::class)->name('sameday.needassigned.detail');
  Route::get('/sameday-on-delivery-detail/{kecamatanId}', SameDayOnDeliveryDetail::class)->name('sameday.ondelivery.detail');
  Route::get('/sameday-done-detail/{branchId}', SameDayOnDoneDetail::class)->name('sameday.done.detail');

  // Merchant
  Route::get('/merchant/paket-detail/{noResi}', [InstanDetailController::class, 'show']);
  Route::get('/merchant/paket-instan', MerchantGetAllPaketInstan::class)->name('merchant.paket-instan');
  Route::get('/komisi-driver', DriverCommission::class)->name('driver-commision');
  Route::get('/merchant/paket-sameday-detail/{noResi}', [SamedayDetailController::class, 'show'])->name('merchant.paket-sameday-detail');
  Route::get('/merchant/paket-sameday', MerchantGetAllPaketSameday::class)->name('merchant.paket-sameday');
  Route::get('/merchant/tracking', MerchantTracking::class)->name('merchant.tracking');
  Route::get('/rekening', Rekening::class)->name('rekening');

  Route::get('/merchant-cabang', [MerchantCabangController::class, 'index'])->name('merchant-cabang.index');

  // Route to handle the branch creation form submission
  Route::post('/merchant-cabang', [MerchantCabangController::class, 'createBranch'])->name('branches.create');

  // Routes to dynamically load kabupaten and kecamatan based on selected provinsi and kabupaten
  Route::get('/load-kabupaten', [MerchantCabangController::class, 'loadKabupaten'])->name('load.kabupaten');
  Route::get('/load-kecamatan', [MerchantCabangController::class, 'loadKecamatan'])->name('load.kecamatan');

  Route::get('/branch-detail/{branchId}', [BranchDetailController::class, 'show'])->name('branch.detail');

  Route::get('/ongkir', Ongkir::class)->name('ongkir');
  Route::get('/cashback', Cashback::class)->name('cashback');
  Route::get('/logo', Logo::class)->name('logo');

  // Create Shipping Sameday
  Route::get('/create-sameday', [SamedayCreateShippingController::class, 'index']);
  Route::post('/create-sameday-shipping/add-product', [SamedayCreateShippingController::class, 'addProduct'])->name('addProduct');
  Route::post('/create-sameday-shipping/remove-product/{index}', [SamedayCreateShippingController::class, 'removeProduct'])->name('removeProduct');
  Route::post('/create-sameday-shipping/submit', [SamedayCreateShippingController::class, 'submit'])->name('submit');
  Route::get('/create-sameday-shipping/kabupaten', [SamedayCreateShippingController::class, 'getKabupaten']);
  Route::get('/create-sameday-shipping/kecamatan', [SamedayCreateShippingController::class, 'getKecamatan']);
  // Create Shipping Instan
  // Create Shipping Sameday
  Route::get('/create-instant', [InstanCreateShippingController::class, 'index'])->name('create-instant');
  Route::post('/create-instant-shipping/add-product', [InstanCreateShippingController::class, 'addProduct'])->name('instant-addProduct');
  Route::post('/create-instant-shipping/remove-product/{index}', [InstanCreateShippingController::class, 'removeProduct'])->name('instant-removeProduct');
  Route::post('/create-instant-shipping/submit', [InstanCreateShippingController::class, 'submit'])->name('instant-submit');
  Route::get('/create-instant-shipping/kabupaten', [InstanCreateShippingController::class, 'getKabupaten']);
  Route::get('/create-instant-shipping/kecamatan', [InstanCreateShippingController::class, 'getKecamatan']);

  Route::get('/profile', [Profile::class, 'index'])->name('profile');

  // SSE
  Route::get('/sse', [SSEController::class, 'stream']);
});
Route::get('/registrasi', [RegistrasiMerchantControler::class, 'showRegistrationForm']);
Route::post('/registrasi', [RegistrasiMerchantControler::class, 'register'])->name('merchant.register');
Route::get('/coba', [RegistrasiMerchantControler::class, 'coba']);
