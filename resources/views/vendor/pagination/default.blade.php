@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Botón "Anterior" --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled"><span class="fa fa-arrow-circle-left"></span></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><span class="fa fa-arrow-circle-left"></span></a>
        @endif

        {{-- Enlaces de páginas --}}
        @foreach ($elements as $element)
            {{-- "Tres puntos" de separación --}}
            @if (is_string($element))
                <a href="#" class="disabled">{{ $element }}</a>
            @endif

            {{-- Enlaces numéricos --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="page active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="page">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botón "Siguiente" --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><span class="fa fa-arrow-circle-right"></span></a>
        @else
            <a href="#" class="disabled"><span class="fa fa-arrow-circle-right"></span></a>
        @endif
    </div>
@endif
