<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DriverRegistration extends Component
{

    public $provinsiId;
    public $kabupatenId;
    public $kecamatanId;
    public $unitKendaraanId;

    public $provinsi = [];
    public $kabupaten = [];
    public $kecamatan = [];

    public $username;
    public $password;
    public $nik;
    public $fullname;
    public $contact;
    public $alamat;
    public $kelurahan;

    public $province;
    public $unitKendaraan;


    public function mount()
    {
        $this->provinsi();
        $this->unitKendaraan();
    }
    protected $rules = [
        'username' => 'required',
        'password' => 'required',
        'nik' => 'required',
        'fullname' => 'required',
        'contact' => 'required',
        'alamat' => 'required',
        'provinsiId' => 'required|integer',
        'kabupatenId' => 'required|integer',
        'kecamatanId' => 'required|integer',
        'kelurahan' => 'required',
        'unitKendaraanId' => 'required',
    ];

    public function registerDriver()
    {
        $url = env('API_BASE_URL');
        $this->validate();
        // dd($this->kabupatenId);
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url.'driver/registrasi', [
            'user' => [
                'username' => $this->username,
                'password' => $this->password,
            ],
            'unitKendaraanId'=> (int) $this->unitKendaraanId,
            'detail' => [
                'nik' => $this->nik,
                'fullname' => $this->fullname,
                'contact' => $this->contact,
                'alamat' => $this->alamat,
                'provinsiId' => (int) $this->provinsiId,
                'kabupatenId' => (int) $this->kabupatenId,
                'kecamatanId' => (int) $this->kecamatanId,
                'kelurahan' => $this->kelurahan,
            ]
        ]);

        if ($response->successful()) {
            $this->dispatch('swal', [
                'title' =>  'Success',
                'text' => 'Driver registered successfully!',
                'icon' => 'success'
            ]);
            // session()->flash('message', 'Driver registered successfully!');
        } else {
            // dd($response->json());
            // session()->flash('error', 'Failed to register driver.');
            $this->dispatch('swal', [
                'title' =>  'Failed',
                'text' => $response->json()['errors']['message'],
                'icon' => 'error'
            ]);
        }
    }
    public function unitKendaraan()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'layanan/unit-kendaraan');

        if ($response->successful()) {
            $this->unitKendaraan = $response->json();
        } else {
            $this->unitKendaraan = null;

        }
    }
    public function provinsi()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'layanan/provinsi');

        if ($response->successful()) {
            // dd($response->json()); 
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
    public function render()
    {
        return view('livewire.driver-registration');
    }
}
