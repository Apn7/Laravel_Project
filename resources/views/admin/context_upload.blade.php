@extends('admin.alayout')
@section('title', 'Context Upload')
@section('content')
<div class="container">
    <h1>Add New Meme Context</h1>
    <div class="">
    <form action="{{route('admin.uploadContext')}}" method="POST" enctype="multipart/form-data" style="width: 600px">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" class="form-control" id="imgurl" name="imgurl">
        </div>
        <button type="submit" class="btn btn-success">Add Context</button>
    </form>
</div>
</div>
@endsection
