@if ($paginator->hasPages())
<nav class="pagination-body">
    <ul class="pagination pagination-body__content">
        <!-- Previous Page Link -->
        @cannot('update', Model::class)

        @endcannot
        @if ($paginator->onFirstPage())
        <li class="page-item disabled pagination-body__previous-button" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">&laquo;</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link pagination-body__previous-button" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
        </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active pagination-body__link-button" aria-current="page"><span class="page-link pagination-body__link-button-content">{{ $page }}</span></li>
        @else
        <li class="page-item pagination-body__link-button"><a class="page-link pagination-body__link-button-content" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link pagination-body__next-button" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
        </li>
        @else
        <li class="page-item disabled pagination-body__next-button" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true">&raquo;</span>
        </li>
        @endif
    </ul>
</nav>
@endif