@php
    $tags = implode(', ', $tagsCsv);
@endphp

<ul class="list-unstyled d-flex">
    @foreach ($tags as $tag)
        <li class="mr-2">
            <a href="/?tag={{$tag}}" class="btn btn-danger rounded-pill mr-2">
                {{ $tag }}
            </a>
        </li>
    @endforeach
</ul>

