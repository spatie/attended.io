<div>
    @if($paginator->nextPageUrl())
        <a href="{{ $paginator->nextPageUrl() }}">
            {{ $nextLabel }}
        </a>
    @endif

    @if($paginator->previousPageUrl())
        <a href="{{ $paginator->previousPageUrl() }}">
            {{ $previousLabel }}
        </a>
    @endif
</div>