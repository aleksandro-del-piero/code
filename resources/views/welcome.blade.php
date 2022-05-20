@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Main page</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Page</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td><a href="{{ route('users') }}">Users list</a></td>

            </tr>
            <tr>
                <th scope="row">2</th>
                <td><a href="{{ route('images.create') }}">Form for crop image</a></td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection
