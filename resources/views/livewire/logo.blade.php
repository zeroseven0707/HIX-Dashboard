<!-- start page content wrapper-->
<div class="page-content-wrapper">
    <!-- start page content-->
    <div class="page-content">
        <div class="container mt-5">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        
            <h2>Upload Logo</h2>
            <form wire:submit.prevent="uploadfile" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">file</label>
                    <input type="file" class="form-control" id="file" wire:model="file">
        
                    @error('file') 
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        
            @if ($file)
                <div class="mt-3">
                    <h4>Preview:</h4>
                    <img src="{{ $file->temporaryUrl() }}" alt="file Preview" class="img-thumbnail">
                </div>
            @endif
        </div>
        
    </div>
</div>

