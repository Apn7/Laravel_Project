@extends('layout')
@section('title', 'Trending Memes')
@section('content')

<div class="container mt-3">
    <div class="row">
        <!-- Sidebar for categories -->
        <div class="col-md-3">

            @if (Auth::check())
                <div class="container mb-3">
                    <div class="container text-center">
                        <h1 class="mt-5">Upload a Meme</h1>
                    </div>
                    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data"
                        class="ms-auto me-auto mt-3" style="width: 300px">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            {{-- <input type="text" class="form-control" id="description" name="description" required> --}}
                            <textarea id="description" name="description" rows="2" class="form-control mb-2" placeholder="Write a description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags"> Tags (Comma Separated) </label>
                            <input type="text" class="form-control" id="tags" name="tags">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="imgurl" name="imgurl" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            @endif


            <div class="list-group">
                <a href="{{route('trending')}}" class="list-group-item list-group-item-action">Trending Memes</a>
                @auth
                <a href="{{route('my_feed')}}" class="list-group-item list-group-item-action">My Feed</a>
                @endauth
                <a href="{{route('memeContext')}}" class="list-group-item list-group-item-action">Meme Context</a>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-6 scrollable-container">

            <div class="container text-center">
                <h2 class="mt-3">Trending Memes</h2>

            </div>


            @include('show_memes')

            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-auto">
                        {{ $memes->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="container text-center mb-3">
                <h1 class="mt-4">Trending Tags</h1>
            </div>
            {{-- <div class="btn-group-vertical">
                @foreach ()
                    <button type="button" class="btn btn-outline-secondary">{{ $tag }} ({{ $count }})</button>
                @endforeach
            </div> --}}
            <div class="container">
                <div class="row">
                    @php $i = 0; @endphp
                    @foreach ($topTags as $tag => $count)
                        @if ($i % 3 == 0 && $i != 0)
                            </div>
                            <div class="row mt-2">
                        @endif
                        <div class="col-md-4">
                            <a href="/?tag={{ $tag }}" class="btn btn-danger rounded-pill">
                                {{ $tag }}({{ $count }})
                            </a>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
