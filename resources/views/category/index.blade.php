@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Category</h3>
            </div>
            <div class="card-body row">
                <div class="col-3">
                    <a href="{{ route('category.create') }}" class="btn btn-success mb-2">Create</a>
                </div>
                <x-alert />
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-warning me-3">EDIT</a>
                                    <x-button.delete :action="route('category.destroy', $category->id)"/>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Category is Empty</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
