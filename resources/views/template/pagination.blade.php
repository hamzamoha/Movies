@if ($paginator->hasPages())
<nav class="text-center">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li><a class="prev disabled">&laquo;</a></li>
        @else
        <li><a class="prev" href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li><a class="disabled">{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li><a class="disabled active">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li><a class="next" href="{{  $paginator->nextPageUrl() }}">&raquo;</a></li>
        @else
        <li><a class="next disabled">&raquo;</a></li>
        @endif
    </ul>
</nav>
@endif
