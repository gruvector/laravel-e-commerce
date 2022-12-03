@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>{{ trans('admin::admin.pagination.previous') }}</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ trans('admin::admin.pagination.previous') }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ trans('admin::admin.pagination.next') }}</a></li>
        @else
            <li class="disabled"><span>{{ trans('admin::admin.pagination.next') }}</span></li>
        @endif
    </ul>
@endif
