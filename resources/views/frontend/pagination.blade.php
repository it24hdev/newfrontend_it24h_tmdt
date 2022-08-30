@if ($paginator->hasPages())
    <nav class="pagination">
        <ul class="page-numbers">
            @if ($paginator->onFirstPage())
                <li hidden>
                    <a class="next page-numbers">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @else
                <li>
                    <a class="next page-numbers" href="{{ $paginator->previousPageUrl() }}">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="page-numbers current">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li>
                    <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li hidden>
                    <a class="next page-numbers">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
@endif

