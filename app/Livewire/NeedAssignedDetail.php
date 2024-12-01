<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NeedAssignedDetail extends Component
{
    public $kecamatanId;
    public $details = [];
    public $drivers = [];
    public $pagination = [
        'page' => 1,
        'lastPage' => 1
    ];

    public function mount($kecamatanId)
    {
        $this->kecamatanId = $kecamatanId;
        $this->fetchDetails();
        $this->listDriver();
    }

    public function fetchDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'regular/sameday/pickup-done/detail', [
            'take' => 4,
            'page' => 1,
            'kecamatanId' => $this->kecamatanId
        ]);

        if ($response->successful()) {
            $this->details = $response->json();
        } else {
            $this->details = [];
        }
    }

    public function listDriver()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'driver/all-driver', [
            'take' => 100,
            'page' => $this->pagination['page'], // Use current page for drivers
            'unitKendaraanId' => $this->details['paket'][0]['unitKendaraanId'] ?? null
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->drivers = $data['driver'];
            $this->pagination['page'] = $data['meta']['page'];
            $this->pagination['lastPage'] = $data['meta']['lastPage'];
        } else {
            $this->drivers = [];
        }
    }

    public function previousPage()
    {
        if ($this->pagination['page'] > 1) {
            $this->pagination['page']--;
            $this->listDriver();
        }
    }

    public function nextPage()
    {
        if ($this->pagination['page'] < $this->pagination['lastPage']) {
            $this->pagination['page']++;
            $this->listDriver();
        }
    }

    public function gotoPage($page)
    {
        $this->pagination['page'] = $page;
        $this->listDriver();
    }

    // asign driver
    public function assignDriver($driverId)
    {
        // dd($driverId);
        $base_url = env('API_BASE_URL');
        $url = $base_url . 'regular/sameday/pickup-done/assign?kecamatanId=' . $this->details['kecamatan']['id'] . '&driverId=' .  $driverId;

        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url);

        if ($response->successful()) {
            session()->flash('message', 'Driver assigned successfully!');
            return redirect('/shipping-sameday#need-assigned-tab');
        } else {
            session()->flash('error', 'Failed to assign driver.');
        }
    }
    public function back()
    {
        return redirect('/shipping-sameday#need-assigned-tab');
    }
    public function render()
    {
        return view('livewire.need-assigned-detail');
    }
}
