@if ($paginator->hasPages())
    <div class="reviews__pagination">
         <div class="pagination">
            @if (!$paginator->onFirstPage())
                <a class="pagination__item pagination__prev" href="{{ $paginator->previousPageUrl() }}">
                    <img src="/comcash/img/icons/prev.svg" alt="{{env('APP_NAME')}}"/>
                </a>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <div class="pagination__item active">
                            ...
                    </div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="pagination__item active">
                                {{ $page }}
                            </div>
                        @else
                            <a class="pagination__item" href="{{ $url }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a class="pagination__item pagination__next" href="{{ $paginator->nextPageUrl() }}">
                    <img src="/comcash/img/icons/next.svg" alt="{{env('APP_NAME')}}"/>
                </a>
            @endif
        </div>
    </nav>
@endif
