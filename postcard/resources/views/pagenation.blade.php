<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="{{ $pager->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
@for( $n = 1; $n <= $pager->lastPage(); $n++ )
        <li class="page-item @if( $n == $pager->currentPage() ) active @endif">
            <a class="page-link" href="{{ $pager->url( $n ) }}">{{ $n }} @if( $n == $pager->currentPage() )<span class="sr-only">( current )</span>@endif</a>
        </li>
@endfor
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
{{--

現在のページに表示されている件数: {{ $data->count() }}
現在のページ数: {{ $data->currentPage() }}
現在のページの最初の要素: {{ $data->firstItem() }}
次のページがあるかどうか: {{ $data->hasMorePages() }}
現在のページの最後の要素: {{ $data->lastItem() }}
最後のページ数: {{ $data->lastPage() }}
次のページのURL: {{ $data->nextPageUrl() }}
1ページに表示する件数: {{ $data->perPage() }}
前のページのURL: {{ $data->previousPageUrl() }}
合計件数: {{ $data->total() }}
指定ページのURL: {{ $data->url(4) }}

--}}