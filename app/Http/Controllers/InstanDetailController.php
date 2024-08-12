<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstanDetailController extends Controller
{
    public function show($noResi)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url."merchant/paket/detail", [
            'noResi' => $noResi
        ]);

        $details = $response->json();

        return view('instan-detail', ['details' => $details]);
    }
}
