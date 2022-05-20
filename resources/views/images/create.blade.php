@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{ route('welcome') }}" class="btn btn-success mb-4">Welcome page</a>
        <h2>Form for crop image</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('messageError'))
            <div class="alert alert-danger">{{ session()->get('messageError') }}</div>
        @endif

        @if(session()->has('messageSuccess'))
            <div class="image-container px-4 py-5 my-5 text-center d-flex justify-content-center flex-column align-items-center">
                <h3>Cropped image by service <a href="https://tinify.com/" class="mb-4 mt-4">Tinify.com</a></h3>
                <img src="{{ session()->get('messageSuccess') }}" class="img-thumbnail mb-4 mt-4" style="max-width: 250px" alt="Cropped image from service Tiny">
                <a href="{{ session()->get('messageSuccess') }}" target="_blank" class="block">Download</a>
            </div>
        @endif

        <form enctype="multipart/form-data" action="{{ route('images.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="image-crop" class="form-label">Image for crop</label>
                <input type="file" class="form-control" id="image-crop" aria-describedby="image-crop" name="image">
                <div id="image-crop" class="form-text">Please, select your image for crop.</div>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

@endsection
