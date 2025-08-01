<nav aria-label="breadcrumb" class="d-inline-block">
    <ol class="breadcrumb">
        @foreach ($crumbs = Theme::breadcrumb()->getCrumbs() as $i => $crumb)
            @if ($i != (count($crumbs) - 1))
                <li class="breadcrumb-item">
                    <a href="{{ custom_url($crumb['url']) }}" title="{{ $crumb['label'] }}">
                        {{ $crumb['label'] }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {!! $crumb['label'] !!}
                </li>
            @endif
        @endforeach
    </ol>
</nav>