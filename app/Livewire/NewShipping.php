<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NewShipping extends Component
{
    public $data = [];
    public function mount()
    {
        $this->fetchData();
    }
    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/Requested', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->data = $response->json()['data'];
        } else {
            // Handle error
            $this->data = [];
        }
    }
    public function render()
    {
        return view('livewire.new-shipping');
    }
}
