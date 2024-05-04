@extends('layout')
@section('title', 'Home Page')
@section('content')

    {{-- upload image when logged in --}}

    <div class="container text-center">
        <h1 class="mt-5">Welcome to MemeGrove</h1>
        <h3 class="mt-3">
            @auth
                Welcome, {{ Auth::user()->username }}!
            @else
                Welcome, Guest!
            @endauth
        </h3>
    </div>

    @if (Auth::check())
        <div class="container">
            <div class="container text-center">
                <h1 class="mt-5">Upload a Meme</h1>
            </div>
            <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data" class="ms-auto me-auto mt-3"
                style="width: 500px">
                @csrf
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="imgurl" name="imgurl" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    @endif

    @include('show_memes')

    <div class="container">
        <div class="mt-5 text-center">
            {{ $memes->onEachSide(1)->links() }}
        </div>
    </div>

@endsection
