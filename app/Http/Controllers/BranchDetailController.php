<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BranchDetailController extends Controller
{
    public function show($branchId)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'merchant/branch/detail', [
            'branchId' => $branchId
        ]);
        // dd(json_decode($response));
        $branch = $response->json();

        return view('branch-detail', ['branch' => $branch]);
    }
}
