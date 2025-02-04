@if ($paginator->hasPages())
    <nav class="pagination-container" aria-label="Pagination">
        <ul class="pagination">
            {{-- Tombol "Previous" --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&laquo; Previous</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
            @endif

            {{-- Tombol Halaman --}}
            @foreach ($elements as $element)
                {{-- Tanda "..." --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Link ke Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol "Next" --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
            @else
                <li class="disabled"><span>Next &raquo;</span></li>
            @endif

            {{-- Input Manual --}}
            <li class="go-to-page">
                <form action="{{ url()->current() }}" method="GET">
                    <input 
                        type="number" 
                        name="page" 
                        min="1" 
                        max="{{ $paginator->lastPage() }}" 
                        placeholder="Page..." 
                        class="pagination-input" 
                    />
                    <button type="submit" class="pagination-button">Go</button>
                </form>
            </li>
        </ul>
    </nav>
@endif
