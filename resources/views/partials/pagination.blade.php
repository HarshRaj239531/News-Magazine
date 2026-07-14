@if ($paginator->hasPages())
    <nav class="custom-pagination" role="navigation" aria-label="Pagination Navigation" style="display: flex; align-items: center; justify-content: space-between; margin-top: 25px; flex-wrap: wrap; gap: 15px; border-top: 1px solid var(--border-color); padding-top: 20px;">
        <!-- Left Side: Results Info -->
        <div class="pagination-info" style="font-size: 0.85rem; color: var(--text-muted); font-weight: 500;">
            {!! __('Showing') !!}
            <span style="font-weight: 700; color: var(--text-dark);">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span style="font-weight: 700; color: var(--text-dark);">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span style="font-weight: 700; color: var(--text-dark);">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </div>

        <!-- Right Side: Navigation Buttons -->
        <ul class="pagination-pages" style="display: flex; list-style: none; gap: 6px; padding: 0; margin: 0; align-items: center; flex-wrap: wrap;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; background-color: var(--body-bg); color: var(--text-muted); font-size: 0.85rem; cursor: not-allowed; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box;">&larr;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; background-color: var(--card-bg); color: var(--text-dark); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box; transition: var(--transition-smooth);">
                        &larr;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span style="padding: 8px 12px; font-size: 0.85rem; color: var(--text-muted);">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <span style="padding: 8px 14px; border: 1px solid var(--primary-color); border-radius: 6px; background-color: var(--primary-color); color: white; font-size: 0.85rem; font-weight: bold; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box;">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" style="padding: 8px 14px; border: 1px solid var(--border-color); border-radius: 6px; background-color: var(--card-bg); color: var(--text-dark); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box; transition: var(--transition-smooth);">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; background-color: var(--card-bg); color: var(--text-dark); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box; transition: var(--transition-smooth);">
                        &rarr;
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span style="padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; background-color: var(--body-bg); color: var(--text-muted); font-size: 0.85rem; cursor: not-allowed; display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; box-sizing: border-box;">&rarr;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    /* Premium Hover States */
    .pagination-pages a:hover {
        background-color: var(--sidebar-hover) !important;
        color: var(--primary-color) !important;
        border-color: var(--primary-light) !important;
        transform: translateY(-1px);
        box-shadow: var(--elevation-low);
    }
</style>
