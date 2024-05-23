@extends('layout')
@section('title', 'Edit Meme')
@section('content')

    {{-- Meme Description Edit Form --}}
    <div class="container text-center">
        <h1 class="mt-5">Edit Meme Description</h1>
    </div>
    <form action="{{ route('editMeme') }}" method="post" class="ms-auto me-auto mt-3 p-4 shadow rounded" style="width: 500px; background-color: #f8f9fa;">
        @csrf
        <input type="hidden" name="meme_id" value="{{ $meme->id }}">
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $meme->description }}" required>
        </div>
        <button type="submit" class="btn btn-primary custom-button">Edit Description</button>
    </form>

    {{-- Meme Tags Edit Form --}}
    <div class="container text-center mt-5">
        <h1>Edit Meme Tags</h1>
    </div>
    <form action="{{ route('editMemeTags') }}" method="post" class="ms-auto me-auto mt-3 p-4 shadow rounded" style="width: 500px; background-color: #f8f9fa;">
        @csrf
        <input type="hidden" name="meme_id" value="{{ $meme->id }}">
        <div class="form-group mb-3">
            <label for="tags" class="form-label">Tags (press enter to add tag) </label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{ ($meme->tags) }}" required>
        </div>
        <button type="submit" class="btn btn-primary custom-button">Edit Tags</button>
    </form>

@endsection
