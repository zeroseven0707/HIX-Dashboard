<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDayOnDeliveryDetail extends Component
{
    public $kecamatanId;
    public $details = [];
    public $page = 1;
    public $totalPages = 1;

    public function mount($kecamatanId)
    {
        $this->kecamatanId = $kecamatanId;
        $this->fetchDetails();
    }

    public function fetchDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/delivery/detail', [
            'take' => 6,
            'page' => $this->page,
            'kecamatanId' => $this->kecamatanId
        ]);
        if ($response->successful()) {
            $data = $response->json();
            $this->details = $response->json();
            $this->totalPages = $data['meta']['total']; // Total halaman dari respons
        } else {
            // Handle error
            $this->details = [];
            $this->totalPages = 1; // Set total pages ke 1 jika ada error
        }
    }
    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetchDetails();
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchDetails();
        }
    }
    public function back()
    {
        return redirect('/shipping-sameday#on-delivery-tab');
    }
    public function render()
    {
        return view('livewire.same-day-on-delivery-detail');
    }
}
