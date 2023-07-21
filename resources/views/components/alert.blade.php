<div class="col-9">
    {{-- Alert Message --}}
    @if (session('success'))
        {{-- Jika alert data sukses --}}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        {{-- Jika aler --}}
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
</div>
