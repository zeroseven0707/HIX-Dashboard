<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingRequestDetailController extends Controller
{
    public function index($noResi)
    {
        $url = env('API_BASE_URL');

        // Fetch shipping detail
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'regular/detail/' . $noResi);

        // Fetch drivers with pagination
        $page = request('page', 1);  // Get the current page, default to 1 if not set
        $driverResponse = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'driver/all-driver', [
            'take' => 5,  // Number of drivers per page
            'verifStatus' => 'Accepted',
            'page' => $page
        ]);

        if ($response->successful() && $driverResponse->successful()) {
            $shippingDetail = $response->json()['shippingDetail'];
            $drivers = $driverResponse->json()['driver'];

            // Pagination data from the meta key
            $pagination = $driverResponse->json()['meta'];
        } else {
            $shippingDetail = null;
            $drivers = null;
            $pagination = null;
        }

        return view('shipping-request-detail', [
            'shippingDetail' => $shippingDetail,
            'drivers' => $drivers,
            'pagination' => $pagination,  // Ensure pagination data is passed to the view
            'noResi' => $noResi
        ]);
    }


    public function assignDriver($noResi, $driverId)
    {
        $base_url = env('API_BASE_URL');
        $url = $base_url . 'assign/regular/instant/' . $noResi . '?driverId=' . (int) $driverId;

        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url);
        // dd(json_decode($response));

        if ($response->successful()) {
            session()->flash('success', 'Driver assigned successfully!');
        } else {
            dd(json_decode($response));
            session()->flash('error', 'Failed to assign driver.');
        }

        return redirect('shipping-on');
    }
}
