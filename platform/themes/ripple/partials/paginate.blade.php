<div class="d-flex flex-wrap mr-3">
    @if ($paginator->onFirstPage())
    <a class="btn btn-icon btn-sm btn-light-success disabled mr-2 my-1">
        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
    </a>
    @else
    <a href="{{ $paginator->previousPageUrl() . $filter }}" class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
        <i class="ki ki-bold-arrow-back icon-xs"></i>
    </a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
        <a class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{ $element }}</a>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="btn btn-icon btn-sm border-0 btn-hover-success active mr-2 my-1"><strong>{{ $page }}</strong></a>
                @else
                    <a href="{{ $url . $filter }}" class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() . $filter }}" class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
        <i class="ki ki-bold-arrow-next icon-xs"></i>
    </a>
    @else
    <a class="btn btn-icon btn-sm btn-light-success disabled  mr-2 my-1">
       <i class="ki ki-bold-double-arrow-next icon-xs"></i>
    </a>
    @endif

</div>
<div class="d-flex align-items-center">
    <span class="text-muted">
        {{ trans('Paginate Display') }}
        {{ trans('Paginate From') }}
        {{ $paginator->firstItem() }}
        {{ trans('Paginate To') }}
        @if($paginator->lastPage())
        {{ $paginator->lastItem() }}
        @else
        {{ $paginator->firstItem() + $paginator->perPage() - 1 }}
        @endif
        {{ trans('Paginate Of') }}
        {{ $paginator->total() }}
    </span>
</div>


