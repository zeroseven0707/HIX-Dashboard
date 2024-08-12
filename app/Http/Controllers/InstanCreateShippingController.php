<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstanCreateShippingController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = session()->get('apiKey');
    }

    public function index()
    {
        $provinces = $this->getProvinces();
        return view('instant-create', compact('provinces'));
    }

    public function getProvinces()
    {
        $url = env('API_BASE_URL') . 'layanan/provinsi';
        $response = Http::withHeaders(['api-key' => $this->apiKey])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function loadKabupaten(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'layanan/kabupaten', [
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
        ])->get($url.'layanan/kecamatan', [
            'kabupatenId' => $request->kabupatenId
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([]);
        }
    }

    public function addProduct(Request $request)
    {
        $products = $request->session()->get('products', []);
        $products[] = ['product' => '', 'quantity' => 1];
        $request->session()->put('products', $products);

        return redirect()->back();
    }

    public function removeProduct(Request $request, $index)
    {
        $products = $request->session()->get('products', []);
        unset($products[$index]);
        $products = array_values($products); // Reindex array
        $request->session()->put('products', $products);

        return redirect()->back();
    }
    
    public function submit(Request $request)
    {
        $url = env('API_BASE_URL') . 'regular/instant';
        $products = $request->products;
        $shipping_detail = $request->shipping_detail;
        $penerima = $request->penerima;
        
        foreach ($products as &$product) {
            $product['quantity'] = (int) $product['quantity'];
        }
        $shipping_detail['berat'] = (float) $shipping_detail['berat'];
        $shipping_detail['payment_total'] = (float) $shipping_detail['payment_total'];
        $penerima['provinsiId'] = (int) $penerima['provinsiId'];
        $penerima['kabupatenId'] = (int) $penerima['kabupatenId'];
        $penerima['kecamatanId'] = (int) $penerima['kecamatanId'];
        
        $data = [
            'products' => $products,
            'shipping_detail' => $shipping_detail,
            'penerima' => $penerima,
        ];
        $response = Http::withHeaders(['api-key' => $this->apiKey])->post($url, $data);
        // dd(json_decode($response));    
        if ($response->successful()) {
                return back()->with('message','successfully created shipping Instan');
                $this->resetInputFields($request);
            } else {
            return back()->with('error','creating failed shipping Instan');
            }

    }

    private function resetInputFields(Request $request)
    {
        $request->session()->put('products', []);
        $request->session()->put('shipping_detail', [
            'payment' => '',
            'berat' => 0,
            'payment_total' => 0
        ]);
        $request->session()->put('penerima', [
            'provinsiId' => 0,
            'kabupatenId' => 0,
            'kecamatanId' => 0,
            'kelurahan' => '',
            'koordinat' => [
                'long' => '',
                'lat' => ''
            ]
        ]);
    }
}
