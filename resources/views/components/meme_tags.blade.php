@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);
@endphp

    {{-- <ul class="list-unstyled d-flex">
        @foreach ($tags as $tag)
            <li class="me-2">
                <a href="/?tag={{ $tag }}" class="btn btn-danger rounded-pill mr-2">
                    {{ $tag }}
                </a>
            </li>
        @endforeach
    </ul> --}}
    <div class="container">
        <div class="row">
            @php $i = 0; @endphp
            @foreach ($tags as $tag)
                @if ($i % 3 == 0 && $i != 0)
                    </div>
                    <div class="row mt-2">
                @endif
                <div class="col-md-2">
                    <a href="/?tag={{ $tag }}" class="tag-pill">
                        {{ $tag }}
                    </a>
                </div>
                @php $i++; @endphp
            @endforeach
        </div>
    </div>

