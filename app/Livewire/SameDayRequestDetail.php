<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDayRequestDetail extends Component
{
    public $branchId;
    public $details = [];
    public $page = 1;
    public $totalPages = 1;

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->fetchDetails();

    }

    public function fetchDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/request/detail', [
            'take' => 6,
            'page' => $this->page,
            'branchId' => (int) $this->branchId
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

    public function requestPickup()
    {
        $url = env('API_BASE_URL');
        $respon = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url.'regular/sameday/request/pickup?branchId='.$this->branchId);
        // dd(json_decode($respon));
        return redirect('/shipping-sameday')->with('message','successfully');
        
    }
    public function render()
    {
        return view('livewire.same-day-request-detail');
    }
}
