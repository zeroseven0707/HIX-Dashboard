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
        $response = Http::post($url . 'admin/login', [
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
            // Session::flash('message', 'Login successful!');
            $this->dispatch('swal', [
                'title' =>  'Success',
                'text' => 'Login successfully!',
                'icon' => 'success'
            ]);

            // $this->dispatch('sweet-alert', icon: 'success', title: 'success'); 

            return redirect('dashboard');
        } else {
            $response = Http::post($url . 'merchant/login', [
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

                $this->dispatch('swal', [
                    'title' =>  'Success',
                    'text' => 'Login successfully!',
                    'icon' => 'success'
                ]);
                // Session::flash('message', 'Login successful!');
                return redirect('/dashboard-merchant');
            }
            
            $this->dispatch('swal', [
                'title' =>  'Errors',
                'text' => $response->json()['errors']['message'],
                'icon' => 'error'
            ]);
            $jh = Session::flash('message', 'Login failed: ' . $response->json()['errors']['message']);
            // dd(json_decode($jh));
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

    public function save()
    {
        /// save data

        $this->dispatch('swal', [
            'title' =>  'Success',
            'text' => 'Sata saved successfully',
            'icon' => 'success'
        ]);
    }
}
