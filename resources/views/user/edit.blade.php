@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Halaman Form Tambah User
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="validationCustom01" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom02" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="validationCustom02" name="email" value="{{ old('email', $user->email) }}">
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
                                <option value="ADMIN" @if ($user->roles === 'ADMIN') selected @endif></option>Admin</option>
                                <option value="USER" @if ($user->roles === 'USER') selected @endif>User</option>
                            </select>
                        </div>
                        @error('category')
                            <div class="invalid-feedback">

                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom03" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="validationCustom03" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom03" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="validationCustom03" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script></script>
@endsection
