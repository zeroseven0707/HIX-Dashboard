<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SamedayCreateShippingIntan extends Component
{
    public $products = [];
    public $shipping_detail = [
        'payment' => '',
        'berat' => 0,
        'payment_total' => 0
    ];
    public $penerima = [
        'provinsiId' => 0,
        'kabupatenId' => 0,
        'kecamatanId' => 0,
        'kelurahan' => '',
        'koordinat' => [
            'long' => '',
            'lat' => ''
        ]
    ];
    public $provinsiId;
    public $kabupatenId;
    public $kecamatanId;
    public $province = [];
    public $kabupaten = [];
    public $kecamatan = [];

    public $selectedProvince = null;
    public $selectedKabupaten = null;

    public function mount()
    {
        $this->provinsi();
    }

    public function provinsi()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'layanan/provinsi');

        if ($response->successful()) { 
            $this->province = $response->json();
        } else {
            $this->province = null;

        }
    }

    public function loadKabupaten()
    {
        $url = env('API_BASE_URL');
        if ($this->provinsiId) {
            $response = Http::withHeaders([
                'api-key' => session()->get('apiKey'),
            ])->get($url.'layanan/kabupaten', [
                'provinsiId' => $this->provinsiId
            ]);

            if ($response->successful()) {
                $this->kabupaten = $response->json();
            } else {
                $this->kabupaten = [];
            }

            $this->kecamatan = [];
            $this->kabupatenId = '';
            $this->kecamatanId = '';
        }
    }
    public function loadKecamatan()
    {
        $url = env('API_BASE_URL');
        if ($this->kabupatenId) {
            $response = Http::withHeaders([
                'api-key' => session()->get('apiKey'),
            ])->get($url.'layanan/kecamatan', [
                'kabupatenId' => $this->kabupatenId
            ]);

            if ($response->successful()) {
                $this->kecamatan = $response->json();
            } else {
                $this->kecamatan = [];
            }

            $this->kecamatanId = '';
        }
    }

    public function addProduct()
    {
        session('apiKey');
        $this->products[] = ['product' => '', 'quantity' => 1];
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products); // Reindex array
    }


    public function submit()
    {
        $url = env('API_BASE_URL');
        // Cast numeric values to ensure correct data types
        foreach ($this->products as &$product) {
            $product['quantity'] = (int) $product['quantity'];
        }
        $this->shipping_detail['berat'] = (float) $this->shipping_detail['berat'];
        $this->shipping_detail['payment_total'] = (float) $this->shipping_detail['payment_total'];
        $this->penerima['provinsiId'] = (int) $this->provinsiId;
        $this->penerima['kabupatenId'] = (int) $this->kabupatenId;
        $this->penerima['kecamatanId'] = (int) $this->kecamatanId;
    
        // Correctly format the data for submission
        $data = [
            'products' => $this->products,
            'shipping_detail' => $this->shipping_detail,
            'penerima' => $this->penerima
        ];
    
        $response = Http::withHeaders(['api-key' => session('apiKey')])
                        ->post($url.'regular/sameday', $data);
    
        if ($response->successful()) {
            session()->flash('message', 'Pengiriman berhasil.');
            $this->resetInputFields();
        } else {
            session()->flash('error', 'Pengiriman gagal.');
        }
    }
    private function resetInputFields()
    {
        $this->products = [];
        $this->shipping_detail = [
            'payment' => '',
            'berat' => 0,
            'payment_total' => 0
        ];
        $this->penerima = [
            'provinsiId' => 0,
            'kabupatenId' => 0,
            'kecamatanId' => 0,
            'kelurahan' => '',
            'koordinat' => [
                'long' => '',
                'lat' => ''
            ]
        ];
        $this->provinsiId = null;
        $this->kabupatenId = null;
        $this->kecamatanId = null;
        $this->kabupaten = [];
        $this->kecamatan = [];
    }
    
    public function render()
    {
        return view('livewire.sameday-create-shipping-intan');
    }
}
