<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MerchantCabangController extends Controller
{
    public function index()
    {
        $branches = $this->fetchBranches();
        $province = $this->fetchProvinsi();
        return view('merchant-cabang', compact('branches', 'province'));
    }

    public function fetchBranches()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'merchant/all/branch');

        return $response->json()['data'];
    }

    public function fetchProvinsi()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'layanan/provinsi');

        if ($response->successful()) {
            return $response->json();
        } else {
            return [];
        }
    }

    public function loadKabupaten(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'layanan/kabupaten', [
            'provinsiId' => $request->provinsiId
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([]);
        }
    }

    public function loadKecamatan(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'layanan/kecamatan', [
            'kabupatenId' => $request->kabupatenId
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([]);
        }
    }

    public function createBranch(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url . 'branch/registrasi', [
            'pic' => $request->pic,
            'contact' => $request->contact,
            'alamat' => $request->alamat,
            'koordinat' => [
                'lat' => $request->koordinat_lat,
                'long' => $request->koordinat_long
            ],
            'provinsiId' => (int) $request->provinsiId,
            'kabupatenId' => (int) $request->kabupatenId,
            'kecamatanId' => (int) $request->kecamatanId,
            'kelurahan' => $request->kelurahan
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('message', 'Branch created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create branch.');
        }
    }
}
