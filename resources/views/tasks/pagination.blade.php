<nav class="pagination">

    @if (!$tasks->onFirstPage())
        <a class="btn btn-outline pagination__prev" href="{{ $tasks->previousPageUrl() }}">Previous</a>
    @endif

    <div class="pagination__pages">
        {{ $tasks->currentPage() }} / {{ $tasks->lastPage() }}
    </div>

    @if (!$tasks->onLastPage())
        <a class="btn btn-outline pagination__next" href="{{ $tasks->nextPageUrl() }}">Next</a>
    @endif

</nav>
