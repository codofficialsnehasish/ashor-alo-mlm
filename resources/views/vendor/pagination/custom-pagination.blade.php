@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            <!-- Page Links -->
            @php
                // Calculate start and end page dynamically
                if($paginator->currentPage() >= 5){
                    $start = max(2, $paginator->currentPage() - 1); // Start at 2 to avoid duplicate "1"
                    $end = min($paginator->lastPage(), $start + 2);
                }else{
                    $start = max(2, $paginator->currentPage() - 2); // Start at 2 to avoid duplicate "1"
                    $end = min($paginator->lastPage(), $start + 3);
                }
            @endphp

            <!-- First Page Link -->
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>

            <!-- First Ellipsis -->
            @if ($start > 2)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            <!-- Loop through the pages to display -->
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endfor

            <!-- Last Ellipsis -->
            @if ($end < $paginator->lastPage())
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            <!-- Last Page Link -->
            @if ($end < $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
