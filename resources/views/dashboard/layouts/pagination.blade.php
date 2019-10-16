@if ($paginator->hasPages())
    @php $link_limit = $linksLimit ?? 7; @endphp
    <div class="dataTables_paginate paging_simple_numbers text-bold">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="paginate_button previous disabled"><a href="#">Previous</a></li>
            @else
                <li class="paginate_button previous">
                    <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @php
                    $half_total_links = floor($link_limit / 2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                @endphp

                @if ($from < $i && $i < $to)
                    <li class="paginate_button {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button next">
                    <a href="{{ $paginator->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="paginate_button next disabled">
                    <a href="#">Next</a>
                </li>
            @endif
        </ul>
    </div>
@endif
