@extends('layout')
@section('title', 'edit meme description')
@section('content')

    {{-- meme description edit form --}}

    <div class="container text-center">
        <h1 class="mt-5">Edit Meme Description</h1>
    </div>
    <form action="{{ route('editMeme') }}" method="post" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
        <input type="hidden" name="meme_id" value="{{ $meme->id }}">
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $meme->description }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>

@endsection
