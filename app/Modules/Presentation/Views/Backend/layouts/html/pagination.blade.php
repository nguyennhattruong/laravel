@if ($paginator->hasPages())
    @php
        $query_string = '';
        if (!empty($except = Request::except('page'))) {
            foreach ($except as $key => $value) {
                $query_string .= '&' . $key . '=' . $value;
            }
        }
    @endphp
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() . $query_string }}" class="page-link">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url . $query_string }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() . $query_string }}">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link"><i class="fa fa-angle-right"></i></a>
            </li>
        @endif
    </ul>
@endif
