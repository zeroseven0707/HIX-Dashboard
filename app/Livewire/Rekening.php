<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Rekening extends Component
{
    public $data = [];
    public $accountName;
    public $bankName;
    public $accountNumber;
    public $accountId; // Property to hold the ID of the account to be activated

    // public $activeStatus = 1; // Default to active

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'merchant/rekening');

        if ($response->successful()) {
            $this->data = $response->json()['data'];
        } else {
            $this->data = [];
        }
    }

    public function saveAccount()
    {
        $url = env('API_BASE_URL') . 'merchant/rekening';

        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url, [
            'noRekening' => $this->accountNumber,
            'bank' => $this->bankName,
            'atasNama' => $this->accountName,
            // 'active' => (bool) $this->activeStatus,
        ]);

        if ($response->successful()) {
            // Reset the form
            $this->reset(['accountName', 'bankName', 'accountNumber',]);
            $this->fetchData(); // Reload data
            $this->dispatch('swal', [
                'title' =>  'Success',
                'text' => 'Rekening berhasil ditambahkan',
                'icon' => 'success'
            ]);
            // session()->flash('message', 'Rekening berhasil ditambahkan.');
        } else {
            session()->flash('error', 'Gagal menambahkan rekening.');
        }
    }

    public function activateAccount($accountId)
    {
        $url = env('API_BASE_URL') . 'merchant/rekening/active?id=' . $accountId;
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->patch($url);

        if ($response->successful()) {
            $this->fetchData(); // Reload the data
            $this->dispatch('swal', [
                'title' =>  'Success',
                'text' => 'Rekening berhasil diaktifkan',
                'icon' => 'success'
            ]);
            // session()->flash('message', 'Rekening berhasil diaktifkan.');
        } else {
            session()->flash('error', 'Gagal mengaktifkan rekening.');
        }
    }

    public function deleteAccount($accountId)
    {
        $url = env('API_BASE_URL') . 'merchant/rekening?id=' . $accountId;
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->delete($url);

        if ($response->successful()) {
            $this->fetchData(); // Reload the data
            session()->flash('message', 'Rekening berhasil dihapus.');
        } else {
            session()->flash('error', 'Gagal menghapus rekening.');
        }
    }


    public function render()
    {
        return view('livewire.rekening');
    }
}
