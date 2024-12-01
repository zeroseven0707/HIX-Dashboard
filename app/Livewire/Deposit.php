<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Deposit extends Component
{
    public $detail = null;
    public $deposit = [];
    public $totalDepositeHariIni = [];
    public $shipping;
    public $showDetailModal2 = false;
    public $search = '';

    public function mount()
    {
        $this->deposit(); // Fetch deposits when the component mounts
    }

    public function deposit()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'regular/all-deposite');

        if ($response->successful()) {
            $this->deposit = $response->json()['drivers'];
            $this->totalDepositeHariIni = $response->json()['totalDepositeHariIni'];
        } else {
            $this->deposit = [];
        }
    }

    public function getFilteredDepositsProperty()
    {
        return collect($this->deposit)->filter(function ($item) {
            return str_contains(strtolower($item['fullName']), strtolower($this->search));
        })->values()->all(); // Return the filtered list
    }

    public function detailDeposit($id)
    {
        // \Log::info('Detail deposit called with ID: ' . $id); // This should show up in your logs
        // Ensure $id corresponds to the expected driver ID
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'regular/driver/deposite', [
            'driverId' => $id
        ]);

        // dd($response->json());
        if ($response->successful()) {
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
        ])->put($url . 'regular/driver/deposite?driverId=' . $id);

        if ($response->successful()) {
            $this->showDetailModal2 = false;
        } else {
            $this->detail = null;
            $this->showDetailModal2 = true;
        }
    }

    public function closeModal()
    {
        $this->showDetailModal2 = false;
    }

    // New method to handle search action
    public function searchDeposits()
    {
        $this->deposit(); // Re-fetch all deposits if necessary
    }

    public function render()
    {
        return view('livewire.deposit');
    }
}
