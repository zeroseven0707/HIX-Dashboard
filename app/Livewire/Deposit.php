<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Deposit extends Component
{
    public $detail = null;
    public $deposit;
    public $shipping;
    public $showDetailModal2 = false;

    public function mount()
    {
        $this->deposit();
    }
    public function deposit()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/all-deposite');
        if ($response->successful()) {
            // dd(json_decode($response));
            $this->deposit = $response->json()['drivers'];
        } else {
            // Handle error
            $this->deposit = [];
        }
    }
    public function detailDeposit($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/driver/deposite', [
            'driverId' => $id
        ]);


        if ($response->successful()) {
            // dd($response->json()); 
            $this->detail = $response->json()['driver'];
            $this->shipping = $response->json()['shippings'];
            $this->showDetailModal2 = true;
        } else {
            $this->detail = null;
            $this->showDetailModal2 = false;
        }
    }
    public function updateDeposit($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->put($url.'regular/driver/deposite?driverId='.$id);

        if ($response->successful()) {
            // dd($response->json()); 
            $this->showDetailModal2 = false;
        } else {
            // dd($response->json()); 
            $this->detail = null;
            $this->showDetailModal2 = true;
        }
    }
    public function closeModal()
    {
        $this->showDetailModal2 = false;
    }
    public function render()
    {
        return view('livewire.deposit');
    }
}
