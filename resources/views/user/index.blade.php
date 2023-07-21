@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>USER MANAGEMENT</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <a href="{{ route('user.create') }}" class="btn btn-success mb-2">Create</a>
                    </div>
                    <x-alert />
                </div>
                <table class="table table-striped table-bordered">
                    <thead>

                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning me-3">Edit</a>
                                    <x-button.delete :action="route('user.delete', $user->id)"/>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
