<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SSEController extends Controller
{
    public function stream()
    {
        $url = env('API_BASE_URL');
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        while (true) {
            $response = Http::withHeaders([
                'api-key' => session()->get('apiKey'),
            ])->get($url.'regular/Requested', [
                'take' => 3,
                'page' => 1
            ]);

            $dataCount = 0;
            if ($response->successful()) {
                $data = $response->json()['data'];
                $dataCount = count($data);
            }

            echo "data: " . json_encode(['count' => $dataCount]) . "\n\n";
            ob_flush();
            flush();

            sleep(20);
        }
    }
}
