@extends('layout')
@section('title', 'Home Page')
@section('content')

<form action="{{route('report.post')}}" method="POST" class="text-center mt-5">
    @csrf
    <div class="mb-3">
        <label for="reason" class="form-label">Report Reason</label>
        <input type="hidden" name="meme_id" value="{{ $meme_id }}">
        <textarea class="form-control" id="reason" name="reason" required style="width: 50%; margin: 0 auto;"></textarea>
    </div>
    <button type="submit" class="btn btn-danger">Report Meme</button>
</form>

@endsection
