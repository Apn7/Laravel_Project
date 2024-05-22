@extends('layout')
@section('title', 'Meme Details')
@section('content')

<div class="container mt-3">
    <div class="row">
        <!-- Sidebar for categories -->
        <div class="col-md-3 sidebar"> <!-- Apply sidebar class -->

            @if (Auth::check())
                <div class="mb-3 text-center">
                    <h1>Upload a Meme</h1>
                    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="2" class="form-control mb-2" placeholder="Write a description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags (Comma Separated)</label>
                            <input type="text" class="form-control" id="tags" name="tags">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="imgurl" name="imgurl" required>
                        </div>
                        <button type="submit" class="btn custom-button">Upload</button>
                    </form>
                </div>
            @endif

            <div class="list-group mt-4">
                <a href="{{route('trending')}}" class="list-group-item list-group-item-action">Trending Memes</a>
                @auth
                <a href="{{route('my_feed')}}" class="list-group-item list-group-item-action">My Feed</a>
                @endauth
                <a href="{{route('memeContext')}}" class="list-group-item list-group-item-action">Meme Context</a>
            </div>

        </div>

        <!-- Main content -->
        <div class="col-md-6 scrollable-container">

            @include('detailedMeme')

        </div>

        <div class="col-md-3">

        </div>
    </div>

@endsection
