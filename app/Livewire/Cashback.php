<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Cashback extends Component
{
    public $cashbacks = [];
    public $detail = null;
    public $cashbackAmount = 0;
    public $currentPage;
    public $totalPages;
    public $pagination; // Menambahkan properti pagination

    public function mount()
    {
        $this->fetchCashbacks(1); // Mulai dari halaman 1
    }

    public function fetchCashbacks($page)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'layanan/merchant/cashback?take=10&page=' . $page);

        if ($response->successful()) {
            $this->cashbacks = $response->json()['data'];
            $this->currentPage = $response->json()['meta']['page'];
            $this->totalPages = $response->json()['meta']['lastPage'];
            $this->pagination = $response->json()['meta']; // Menyimpan data pagination
        } else {
            $this->cashbacks = [];
            $this->currentPage = 1;
            $this->totalPages = 1;
            $this->pagination = null; // Atur pagination menjadi null jika gagal
        }
    }

    public function viewDetail($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'cost/detail/cashback?ongkirId=' . $id);
        $this->detail = $response->json();
        $this->cashbackAmount = $this->detail['cashback'];
    }

    public function updateCashback()
    {
        $url = env('API_BASE_URL');
        Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url . 'cost/update/cashback?ongkirId=' . $this->detail['id'], [
            'cashback' => (int) $this->cashbackAmount
        ]);

        $this->fetchCashbacks($this->currentPage); // Memfetch ulang cashbacks di halaman yang sama
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.cashback', [
            'pagination' => $this->pagination, // Menyertakan data pagination ke view
        ]);
    }
}
