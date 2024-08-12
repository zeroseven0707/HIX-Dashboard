<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MerchantPaketInstanDetail extends Component
{
    public $noResi;
    public $details = [];

    public function mount($noResi)
    {
        $this->noResi = $noResi;
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get("https://tedy-dev.my.id/api/merchant/paket/detail", [
            'noResi' => $this->noResi
        ]);

        if ($response->successful() && $response->json()) {
            $this->details = $response->json();
        }
    }

    public function render()
    {
        return view('livewire.merchant-paket-instan-detail');
    }
}
