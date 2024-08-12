<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Profile extends Controller
{
    public function index()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey'), // Pastikan api-key disimpan di session
        ])->get($url.'merchant/profile');

        if ($response->successful()) {
            $profile = $response->json();
            return view('profile', compact('profile'));
        } else {
            return redirect()->back()->with('error', 'Gagal mendapatkan profil merchant.');
        }
    }
}
