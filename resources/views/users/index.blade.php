@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('welcome') }}" class="btn btn-success mb-4">Welcome page</a>
        <h2>Users list</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @isset($users)
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <th scope="row">{{ $user->name }}</th>
                        <th scope="row">{{ $user->email }}</th>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>

        @isset($users)
            <div
                class="btn btn-success"
                id="load-more-users"
                data-next-page-url="{{ $users->nextPageUrl() }}"
            >Load more</div>
        @endisset
    </div>
@endsection
