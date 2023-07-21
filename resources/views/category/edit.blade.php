@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Halaman Form Ubah Category
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="validationCustom01" class="col-form-label col-sm-2">Nama Category</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="validationCustom01" name="name" value="{{ old('name', $category->name) }}">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('category.index') }}" class="btn btn-secondary">cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script></script>
@endsection
