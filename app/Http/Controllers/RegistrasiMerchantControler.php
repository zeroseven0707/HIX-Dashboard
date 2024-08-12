<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrasiMerchantControler extends Controller
{
    public function showRegistrationForm()
    {
        $url = env('API_BASE_URL');
        $jenisUsahaResponse = Http::get($url.'layanan/jenis-usaha');
        $kategoriUsahaResponse = Http::get($url.'layanan/kategori-usaha');

        $jenisUsaha = $jenisUsahaResponse->json();
        $kategoriUsaha = $kategoriUsahaResponse->json();

        return view('registrasi', compact('jenisUsaha', 'kategoriUsaha'));
    }

    public function register(Request $request)
    { 
        $url = env('API_BASE_URL');
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'bussinesName' => 'required',
            'bussinesOwener' => 'required',
            'nomorHp' => 'required',
            'nik' => 'required',
            'jenisUsahaId' => 'required',
            'kategoriUsahaId' => 'required',
        ]);

        $response = Http::post($url.'merchant/registrasi', [
            'username' => $request->username,
            'password' => $request->password,
            'bussinesName' => $request->bussinesName,
            'bussinesOwener' => $request->bussinesOwener,
            'nomorHp' => $request->nomorHp,
            'nik' => $request->nik,
            'jenisUsahaId' => (int) $request->jenisUsahaId,
            'kategoriUsahaId' => (int) $request->kategoriUsahaId,
        ]);
        // dd(json_decode($response));

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Registrasi berhasil!');
        }

        return redirect()->back()->with('error', 'Registrasi gagal. Silakan coba lagi.');
    }
    public function coba()
    {
        $url = env('API_BASE_URL2'); 
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 4|nGBNb4zwVWUoPe93KPakZERzhM0QwZoD1xJjpHFc8cd108e7',
        ])->get($url . 'keywords');
    
        if ($response->successful()) {
            $data = json_decode($response->body(), true); // true untuk hasil sebagai array
            dd($data);
        } else {
            $error = json_decode($response->body(), true);
            dd([
                'status' => $response->status(),
                'error' => $error
            ]);
        }
}
}
