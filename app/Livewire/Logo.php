<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Logo extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadfile()
    {
        $url = env('API_BASE_URL');
        $this->validate([
            'file' => 'required|image|max:1024', // 1MB Max
        ]);

        // Simpan file sementara
        $filePath = $this->file->store('logo', 'public');
        $fileName = $this->file->getClientOriginalName();
        $fileContents = file_get_contents(storage_path('app/public/' . $filePath));

        // Buat request PATCH dengan attach file
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->attach(
            'File', $fileContents, $fileName
        )->patch($url.'merchant/logo');
        // Debugging response
        // dd($response->json());

        if ($response->successful()) {
            session()->flash('message', 'Logo uploaded successfully.');
        } else {
            session()->flash('error', 'Failed to upload logo.');
        }

        // Hapus file sementara setelah upload
        Storage::disk('public')->delete($filePath);

        // Reset input
        $this->reset('file');
    }


    public function render()
    {
        return view('livewire.logo');
    }
}
