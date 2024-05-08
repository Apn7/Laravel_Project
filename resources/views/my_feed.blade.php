@extends('layout')
@section('title', 'My Feed')
@section('content')

    {{-- upload image when logged in --}}

    @include('show_memes')

    <div class="container">
        <div class="mt-5 text-center">
            {{ $memes->onEachSide(1)->links() }}
        </div>
    </div>

@endsection

