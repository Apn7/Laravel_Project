@extends('admin.alayout')
@section('title', 'Meme Context Manage')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-4 text-center">Manage Meme Contexts</h1>
    <div class="list-group">
        @foreach ($contexts as $context)
            <div class="list-group-item p-3 mb-3 shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex flex-column">
                        <h5 class="mb-1"><strong>Title:</strong> {{ $context->title }}</h5>
                        <p class="mb-0"><strong>Description:</strong> {{ $context->description }}</p>
                    </div>
                    <img src="{{ asset('storage/' . $context->imgurl) }}" alt="Context Image" class="img-thumbnail" style="width: 100px; height: auto;">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editContextModal{{ $context->id }}">Edit</button>
                    <form action="{{ route('admin.context.delete', $context->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="editContextModal{{ $context->id }}" tabindex="-1" aria-labelledby="editContextModalLabel{{ $context->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editContextModalLabel{{ $context->id }}">Edit Meme Context</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.context.edit', $context->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title{{ $context->id }}" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title{{ $context->id }}" name="title" value="{{ $context->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $context->id }}" class="form-label">Description</label>
                                    <textarea class="form-control" id="description{{ $context->id }}" name="description" required>{{ $context->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
