<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDay extends Component
{
    public $DataRequest = [];
    public $DataOnPickup = [];
    public $DataOnHold = [];
    public $DataOnDelivery = [];
    public $DataDone = [];
    public $needAssigned = [];
    public $pagination = [
        'request' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
        'onPickup' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
        'onHold' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
        'onDelivery' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
        'Done' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
    ];

    public function mount()
    {
        $this->request();
        $this->onDelivery();
        $this->onHold();
        $this->needAssigned();
        $this->onPickup();
        $this->done();
    }
    
    public function request()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/request', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            // dd(json_decode($response));
            $this->DataRequest = $response->json()['shipping_sameday'];
            // $this->pagination['request']['currentPage'] = $response->json()['meta']['page'];
            // $this->pagination['request']['totalPages'] = $response->json()['meta']['lastPage'];
        } else {
            $this->DataRequest = [];
            // $this->pagination['request']['currentPage'] = 1;
            // $this->pagination['request']['totalPages'] = 1;
        }
    }
    public function onHold()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/on-hold', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnHold = $response->json()['shipping_sameday'];
        } else {
            // Handle error
            $this->DataOnHold = [];
        }
    }
    public function onPickup()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/pickup', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnPickup = $response->json()['shipping_sameday'];
        } else {
            // Handle error
            $this->DataOnPickup = [];
        }
    }
    public function needAssigned()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/pickup-done', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->needAssigned = $response->json()['shipping_sameday_kecamatan'];
        } else {
            // Handle error
            $this->needAssigned = [];
        }
    }
    public function onDelivery()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/delivery', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnDelivery = $response->json()['shipping_sameday_kecamatan'];
        } else {
            // Handle error
            $this->DataOnDelivery = [];
        }
    }
    public function Done()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/done', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataDone = $response->json()['shipping_sameday_kecamatan'];
        } else {
            // Handle error
            $this->DataDone = [];
        }
    }
    public function PickupDone($branchId)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url.'regular/sameday/pickup/done?branchId=' . $branchId);
        if ($response->successful()) {
            // dd(json_decode($response));
            session()->flash('message', 'successfully!');
        } else {
            // Handle error
            session()->flash('error', 'Errored!');
        }
    }

    public function render()
    {
        return view('livewire.same-day', [
            'pagination' => $this->pagination, // Mengirim array pagination ke view
        ]);
    }
}
