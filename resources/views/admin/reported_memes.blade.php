@extends('admin.alayout')
@section('title','Reported Memes')
@section('content')
<div class="container">
    <h1>Reported Memes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Meme</th>
                <th>Reported By</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>
                    <a href="{{ route('meme', $report->meme->id) }}">
                        <img src="{{ asset('storage/' . $report->meme->imgurl) }}" alt="Meme Image" class="img-thumbnail"
                        style="width: 150px; height: auto;">
                    </a>
                </td>
                <td>{{ $report->user->username }}</td>
                <td>{{ $report->reason }}</td>
                <td>
                    <form action="{{route('admin.deleteReport')}}" method="POST">
                        @csrf
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <button type="submit" class="btn btn-danger">Delete Meme</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
