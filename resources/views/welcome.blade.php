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

    <div class="container">
        <div class="mt-5 text-center">Check out the latest memes below:</div>

        <div class="d-flex flex-column align-items-center">
            @foreach ($memes as $meme)
                <div class="card mb-3">
                    <img src="{{ asset('storage/' . $meme->imgurl) }}" class="card-img-top img-fluid"
                        style="max-width: 100%; height: auto;" alt="Meme Image">
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="card-text align-items-left">Uploaded by: {{ $meme->user->username }} </p>
                                @if ($meme->user_id == Auth::id())
                                    {{-- <div class="align-items-right">
                                        <form id="deleteMemeForm" action="{{ route('deleteMeme')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                            <i id="deleteMemeIcon" class="ri-delete-bin-6-line custom-icon"
                                                onclick="memeDeleteForm()" style="cursor: pointer;"></i>
                                        </form>
                                    </div> --}}
                                    //button for delete meme
                                    <form id="deleteMemeForm" action="{{ route('checking') }}" method="post">
                                        @csrf
                                        
                                        <button type="submit" class="btn btn-outline-danger"
                                            style="padding: 5px 10px; border-radius: 20px;">Delete</button>
                                    </form>
                                @endif
                                <p class="card-text">{{ $meme->description }}</p>
                                <!-- Like Button -->
                                @if (Auth::check())
                                    <form action="{{ route('like') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                        <button type="submit" class="btn btn-outline-warning"
                                            style="padding: 5px 10px; border-radius: 20px;"><span
                                                style="font-size: 1.2em;">😆</span></button>
                                    </form>
                                @endif
                                <!-- Total Likes -->
                                <span class="ms-2"><i class="bi bi-heart-fill"></i>
                                    <strong>{{ $meme->likes()->count() }}</strong> Hahas</span>
                            </div>
                        </div>

                        <!-- Comment Section -->

                        <div class="comments">
                            @foreach ($meme->comments as $comment)
                                <div class="comment card mb-3">
                                    <div class="card-body">
                                        <p class="card-text">{{ $comment->content }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span>By: {{ $comment->user->name }}</span>
                                            </div>
                                            @if ($comment->user->id == Auth::id())
                                                <div>
                                                    <form id="deleteCommentForm" action="{{ route('deleteComment') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="comment_id"
                                                            value="{{ $comment->id }}">
                                                        <i id="deleteCommentIcon" class="ri-delete-bin-6-line custom-icon"
                                                            onclick="commentDeleteForm()" style="cursor: pointer;"></i>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Comment Form -->
                            @if (Auth::check())
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form action="{{ route('comment') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                            <textarea name="content" rows="3" class="form-control mb-2" placeholder="Write a comment"></textarea>
                                            <button type="submit" class="btn btn-outline-dark"
                                                style="padding: 5px 15px; border-radius: 20px;">Comment</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function commentDeleteForm() {
            document.getElementById('deleteCommentForm').submit();
        }
        function memeDeleteForm() {
            document.getElementById('deleteMemeForm').submit();
        }
    </script>

@endsection
