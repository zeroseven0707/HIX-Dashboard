<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $responseMessage;

    public function login()
    {
        $url = env('API_BASE_URL');
        $response = Http::post($url.'admin/login', [
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            // Handle successful response
            $this->responseMessage = 'Login successful!';
            $apiKey = $response->json('data.apiKey');
            // dd(json_decode($response));

            // Save apiKey to session
            Session::put('apiKey', $apiKey);
            Session::put('type', 'cabang');
        return redirect('dashboard');
        } else {
            $response = Http::post($url.'merchant/login', [
                'username' => $this->username,
                'password' => $this->password,
            ]);
            if ($response->successful()) {
                // Handle successful response
                $this->responseMessage = 'Login successful!';
                $apiKey = $response->json('data.apiKey');
                // dd(json_decode($response));
    
                // Save apiKey to session
                Session::put('apiKey', $apiKey);
                Session::put('type', 'merchant');
            return redirect('/dashboard-merchant');
            }
            // dd($response->json()['errors']['message']);
            $this->responseMessage = 'Login failed: ' . $response->json()['errors']['message'];
        }
    }
    public function logout()
    {
      Session::forget('apiKey');
      return redirect('/');
    }
    public function indexx()
    {
        return view('login');
    }
}
