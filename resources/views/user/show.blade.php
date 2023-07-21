@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Book</h3>
            </div>
            <div class="card-body row">
                <h3>Book that you created.</h3>
                <p>Total Book : {{ $user->books->count() }}</p>
                <p>Total Stock : {{ $user->books->sum('quantity') }}</p>
                <div class="row">
                    @forelse ($user->books as $key => $book)
                    <div class="col-md-2">
                        <img src="{{ $book->cover_url }}"
                        class="img-thumbnail"
                        style="width: 200px">
                    </div>

                    @empty
                    <div class="col-md-12 text-center">
                        You have not any created book
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
