<div class="pull-right">
    @if ($paginator->hasPages())
        @php $link_limit = 7; @endphp
        <div class="dataTables_paginate paging_simple_numbers">
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
</div>

<li class="paginate_button next" id="datatable-checkbox_next"><a href="#" aria-controls="datatable-checkbox" data-dt-idx="7" tabindex="0">Next</a></li>



<div class="dataTables_paginate paging_simple_numbers">
    <ul class="pagination">
        <li class="paginate_button previous disabled">
            <a href="#" aria-controls="datatable-checkbox" Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="datatable-checkbox" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="datatable-checkbox" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="datatable-checkbox" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="datatable-checkbox" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="datatable-checkbox" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="datatable-checkbox" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="datatable-checkbox_next"><a href="#" aria-controls="datatable-checkbox" data-dt-idx="7" tabindex="0">Next</a></li></ul>
        </div>



<div class="pull-right">
    @if ($users->hasPages())
        <span class="inbox-text">
            {{ $users->firstItem() }} - {{ $users->lastItem() }}/{{ $users->total() }}
        </span>
        <div class="btn-group">
            {{-- Previous Page Link --}}
            @if (!$users->onFirstPage())
                <button type="button" class="previousPage btn btn-default btn-sm waves-effect waves-light">
                    <i class="fa fa-angle-left"></i>
                </button>
            @endif
            {{-- Next Page Link --}}
            @if ($users->hasMorePages())
                <button type="button" class="nextPage btn btn-default btn-sm waves-effect waves-light">
                    <i class="fa fa-angle-right"></i>
                </button>
            @endif
        </div>
        <!-- /.btn-group -->
    @endif
</div>

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