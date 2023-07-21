@extends('layouts.app')

@section('css')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Halaman Form Tambah Book
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="inputTitle" class="col-form-label col-sm-2">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle"
                                name="title" value="{{ old('title', '') }}">
                        </div>
                        @error('title')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="inputDescription" class="col-form-label col-sm-2">Description</label>
                        <div class="col-sm-10">
                            <textarea rows="2" class="form-control @error('description') is-invalid @enderror" id="inputDescription"
                                name="description" value="{{ old('description', '') }}"></textarea>
                        </div>
                        @error('description')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="inputYear" class="col-form-label col-sm-2">Year of Publish</label>
                        <div class="col-sm-10">
                            <input type="number" min="2000" max="{{ date('Y') }}"
                                class="form-control @error('year') is-invalid @enderror" id="inputYear" name="year"
                                value="{{ old('year', date('Y')) }}">
                        </div>
                        @error('year')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="inputQuantity" class="col-form-label col-sm-2">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="inputQuantity" name="quantity" value="{{ old('quantity', '') }}">
                        </div>
                        @error('quantity')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="selectCategory" class="col-form-label col-sm-2">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('category') is-invalid @enderror" id="selectCategory"
                                name="category[]" multiple size="3">
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="inputCover" class="col-form-label col-sm-2">Cover</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('cover') is-invalid @enderror" type="file" id="inputCover"
                                name="cover" value="{{ old('cover', '') }}" accept="image/*">
                        </div>
                        @error('title')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script></script>
@endsection

@section('js')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#selectCategory').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endsection
