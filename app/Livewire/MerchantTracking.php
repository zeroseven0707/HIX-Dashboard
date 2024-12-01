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
    public $pengirim = [];
    public $penerima = [];

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

            // Assign the merchant (pengirim) and recipient (penerima) details
            $this->pengirim = $data['pengirim'] ?? [
                'merchant' => 'Unknown Merchant',
                'logo' => '',
                'cabang' => 'Unknown Branch',
                'alamat' => 'Unknown Address',
            ];

            $this->penerima = $data['penerima'] ?? [
                'nama' => 'Unknown Recipient',
                'alamat' => 'Unknown Address',
            ];

        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            $this->driver = 'Error';
            $this->status = 'Error';
            $this->logs = [];
            $this->pengirim = [];
            $this->penerima = [];
        }
    }

    public function render()
    {
        return view('livewire.merchant-tracking');
    }
}
