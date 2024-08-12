<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MerchantTracking extends Component
{
    public $resi;
    public $driver;
    public $status;
    public $logs = [];

    public function trackOrder()
    {
        $url = env('API_BASE_URL');
        $this->validate([
            'resi' => 'required|string'
        ]);

        try {
            $response = Http::get($url.'regular/log', [
                'noResi' => $this->resi,
            ]);

            $data = $response->json();

            $this->driver = $data['driver'] ?? 'N/A';
            $this->status = $data['status'] ?? 'N/A';
            $this->logs = $data['logs'] ?? [];
        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            $this->driver = 'Error';
            $this->status = 'Error';
            $this->logs = [];
        }
    }
    public function render()
    {
        return view('livewire.merchant-tracking');
    }
}
