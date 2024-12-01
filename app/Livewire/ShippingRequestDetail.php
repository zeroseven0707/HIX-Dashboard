<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShippingRequestDetail extends Component
{
    // public $DataRequest = [];
    // public $DataOnPickup = [];
    // public $DataOnDelivery = [];
    // public $DataAssigned = [];
    // public $DataOnHold = [];
    // public $DataDone = [];
    public $drivers = null;
    public $shippingDetail = null;
    public $showDetailModal = false;
    // public $showBody = false;
    public $noResi;
    // public $pagination = [
    //     'request' => [
    //         'currentPage' => 1,
    //         'totalPages' => 1,
    //     ],
    //     'onPickup' => [
    //         'currentPage' => 1,
    //         'totalPages' => 1,
    //     ],
    //     'onHold' => [
    //         'currentPage' => 1,
    //         'totalPages' => 1,
    //     ],
    //     'onDelivery' => [
    //         'currentPage' => 1,
    //         'totalPages' => 1,
    //     ],
    //     'Done' => [
    //         'currentPage' => 1,
    //         'totalPages' => 1,
    //     ],
    // ];

    public function mount($noResi)
    {
        // $this->request();
        // $this->onDelivery();
        // $this->onPickup();
        // $this->done();
        // $this->assigned();
        // $this->onHold();
        $this->noResi = $noResi;
        $this->fetchDetail($this->noResi);
    }

    // public function request($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/Requested?page={$page}&take={$take}");

    //     // dd($response->json());
    //     if ($response->successful()) {
    //         $this->DataRequest = $response->json()['data'];
    //         $this->pagination['request']['currentPage'] = $response->json()['meta']['page'];
    //         $this->pagination['request']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         $this->DataRequest = [];
    //         $this->pagination['request']['currentPage'] = 1;
    //         $this->pagination['request']['totalPages'] = 1;
    //     }
    // }

    // public function onHold($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/On Hold?page={$page}&take={$take}");

    //     if ($response->successful()) {
    //         $this->DataOnHold = $response->json()['data'];
    //         $this->pagination['onHold']['currentPage'] = $response->json()['meta']['page'];
    //         $this->pagination['onHold']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         // Handle error
    //         $this->DataOnHold = [];
    //         $this->pagination['onHold']['currentPage'] = 1;
    //         $this->pagination['onHold']['totalPages'] = 1;
    //     }
    // }

    // public function assigned($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/Assigned?page={$page}&take={$take}");

    //     if ($response->successful()) {
    //         // dd($response->json());
    //         $this->DataAssigned = $response->json()['data'];
    //         $this->pagination['onPickup']['currentPage'] = $response->json()['meta']['page'];
    //         $this->pagination['onPickup']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         $this->DataAssigned = [];
    //         $this->pagination['onPickup']['currentPage'] = 1;
    //         $this->pagination['onPickup']['totalPages'] = 1;
    //     }
    // }

    // public function onPickup($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/On Pickup?page={$page}&take={$take}");

    //     if ($response->successful()) {
    //         // dd(json_decode());
    //         // dd($response->json()['meta']['lastPage']);
    //         $this->DataOnPickup = $response->json()['data'];
    //         $this->pagination['onPickup']['currentPage'] = $response->json()['meta']['page'];
    //         // $this->pagination['onPickup']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         $this->DataOnPickup = [];
    //         $this->pagination['onPickup']['currentPage'] = 1;
    //         $this->pagination['onPickup']['totalPages'] = 1;
    //     }
    // }

    // public function onDelivery($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/On Delivery?page={$page}&take={$take}");

    //     if ($response->successful()) {
    //         // dd($response->json());
    //         $this->DataOnDelivery = $response->json()['data'];
    //         $this->pagination['onDelivery']['currentPage'] = $response->json()['meta']['page'];
    //         $this->pagination['onDelivery']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         // Handle error
    //         $this->DataOnDelivery = [];
    //         $this->pagination['onDelivery']['currentPage'] = 1;
    //         $this->pagination['onDelivery']['totalPages'] = 1;
    //     }
    // }
    // public function Done($page = 1, $take = 10)
    // {
    //     $url = env('API_BASE_URL');
    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->get("{$url}regular/Done?page={$page}&take={$take}");

    //     if ($response->successful()) {
    //         $this->DataDone = $response->json()['data'];
    //         $this->pagination['Done']['currentPage'] = $response->json()['meta']['page'];
    //         $this->pagination['Done']['totalPages'] = $response->json()['meta']['lastPage'];
    //     } else {
    //         // Handle error
    //         $this->DataDone = [];
    //         $this->pagination['Done']['currentPage'] = 1;
    //         $this->pagination['Done']['totalPages'] = 1;
    //     }
    // }

    // // Fetch data detail shipping
    public function fetchDetail($noResi)
    {
        $url = env('API_BASE_URL');
        // $noResi = $this->noResi;
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'regular/detail/' . $this->noResi);
        $driver = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'driver/all-driver', [
            'take' => 20,
            'verifStatus' => 'Accepted',
            'page' => 1
        ]);

    //     // dd($response->json()); 
    //     // dd($response->json()); 
        if ($response->successful()  && $driver->successful()) {
            $this->shippingDetail = $response->json()['shippingDetail'];
            $this->drivers = $driver->json()['driver'];
            $this->showDetailModal = true; // Tampilkan modal
        } else {
            $this->shippingDetail = null;
            $this->drivers = null;
            $this->showDetailModal = false;
        }
    }
    // // asign driver
    // public function assignDriver($driverId)
    // {
    //     $base_url = env('API_BASE_URL');
    //     $url = $base_url . 'assign/regular/instant/' . $this->noResi . '?driverId=' . (int) $driverId;

    //     $response = Http::withHeaders([
    //         'api-key' => session()->get('apiKey'),
    //     ])->post($url);
    //     // dd(json_decode($response));

    //     if ($response->successful()) {
    //         $this->showDetailModal = false;
    //         session()->flash('message', 'Driver assigned successfully!');
    //     } else {
    //         dd(json_decode($response));
    //         session()->flash('error', 'Failed to assign driver.');
    //     }
    // }
    // public function closeModal()
    // {
    //     $this->showDetailModal = false;
    // }

    // public function toggleBody()
    // {
    //     $this->showBody = !$this->showBody;
    // }
    public function render()
    {
        return view('livewire.shipping-request-detail', [
            // 'pagination' => $this->pagination, // Mengirim array pagination ke view
            // 'shippingDetail' => $this->shippingDetail
        ]);
    }


    // Jika tombol pagination ditekan
    // public function changePage($page)
    // {
    //     $this->request($page);
    // }
}
