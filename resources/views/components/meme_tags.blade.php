@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);
@endphp
<div class="card-body">
    <ul class="list-unstyled d-flex">
        @foreach ($tags as $tag)
            <li class="me-2">
                <a href="/?tag={{ $tag }}" class="btn btn-danger rounded-pill mr-2">
                    {{ $tag }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
