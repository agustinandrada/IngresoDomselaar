@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" style="margin-bottom: -10px; margin-top: 10px; space-between: 10px">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item me-5" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true"
                        style="color: black !important; background-color: white !important; border-color:black !important ;  border-radius: 50% !important">&lsaquo;</span>
                </li>
            @else
                <li class="page-item me-5">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')"
                        style="color: white !important; background-color: black; border:black;  border-radius: 50% ">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span
                            class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active me-1" aria-current="page"><span
                                    style="background-color:#cc1b6f !important; border-color: #cc1b6f !important; border-radius: 50%; color: white;"
                                    class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item me-1"><a class="page-link" href="{{ $url }}"
                                    style="background-color: white !important; color: #cc1b6f !important; border-color: #cc1b6f !important; border-radius: 50%">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ms-5">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                        style="color: white !important; background-color: black; border:black;  border-radius: 50%; "
                        rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled ms-5" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link"
                        style="color: black !important; background-color: white !important; border-color:black !important ;  border-radius: 50% !important; "
                        aria-hidden="true" style="">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
