@extends('layout')
@section('title', 'Meme Context')
@section('content')

{{-- upload image when logged in --}}

<div class="container mt-3">
    <div class="row">
        <!-- Sidebar for categories -->
        <div class="col-md-3 sidebar">
            <!-- Apply sidebar class -->

            {{-- Trigger Modal Button --}}
            <div class="container text-center mt-3">
                @if (Auth::check())
                <button class="btn custom-button" data-bs-toggle="modal" data-bs-target="#uploadMemeModal">Upload a
                    Meme</button>
                @endif
            </div>

            {{-- Upload Meme Modal --}}
            <div class="modal fade" id="uploadMemeModal" tabindex="-1" aria-labelledby="uploadMemeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadMemeModalLabel">Upload a Meme</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" rows="3" class="form-control"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags (press enter to add tag)</label>
                                    <input type="text" id="tags" name="tags" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" id="imgurl" name="imgurl" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn custom-button">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group mt-5 fs-5">
                <a href="{{ route('trending') }}" class="list-group-item list-group-item-action py-2">Trending Memes</a>
                @auth
                <a href="{{ route('my_feed') }}" class="list-group-item list-group-item-action py-2">My Feed</a>
                @endauth
                <a href="{{ route('memeContext') }}" class="list-group-item list-group-item-action py-2">Meme Context</a>
            </div>

        </div>


        <!-- Main content -->
        <div class="col-md-6 scrollable-container">
            <div class="container">
                <h4 class="mb-4 text-center">Check out the latest meme contexts below:</h4>

                <div class="d-flex flex-column align-items-center">
                    @foreach ($memeContexts as $context)
                    <div class="card mb-3 fixed-width-card">
                        @if ($context->imgurl)
                        <img src="{{ asset('storage/' . $context->imgurl) }}" class="card-img-top img-fluid"
                            alt="{{ $context->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $context->title }}</h5>
                            <p class="card-text">{{ $context->description }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ $context->created_at->timezone('Asia/Dhaka')->format('F d, Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-auto">
                        {{ $memeContexts->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>



        <!-- Right sidebar for trending tags -->
        <div class="col-md-3 right-sidebar">
            <div class="container text-center mb-3">
                <h1 class="">Trending Tags</h1>
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
                        <a href="/?tag={{ $tag }}" class="btn tag-btn ">
                            {{ $tag }}({{ $count }})
                        </a>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
