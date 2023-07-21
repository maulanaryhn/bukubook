@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Halaman Form Tambah User
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="validationCustom01" class="col-form-label col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="validationCustom01" name="name" value="{{ old('name', '') }}">
                        </div>
                        @error('name')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="validationCustom02" class="col-form-label col-sm-2">Email address</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="validationCustom02" name="email" value="{{ old('email', '') }}">
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="selectRoles" class="col-form-label col-sm-2">Roles</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('roles') is-invalid @enderror" id="selectRoles" name="roles">
                                <option selected disabled>-- Choose Role --</option>
                                <option value="ADMIN">Admin</option>
                                <option value="USER">User</option>
                            </select>
                        </div>
                        @error('roles')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="validationCustom03" class="col-form-label col-sm-2">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="validationCustom03" name="password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="validationCustom03" class="col-form-label col-sm-2">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="validationCustom03" name="password_confirmation">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script></script>
@endsection
