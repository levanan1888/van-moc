@if ($banners->count() > 0)
    <div id="slideBanners" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($banners as $b => $btn)
                <button type="button" data-bs-target="#slideBanners" data-bs-slide-to="{{ $b }}"
                    class="{{ $b == 0 ? 'active' : '' }}" aria-current="{{ $b == 0 ? true : false }}"
                    aria-label="Slide {{ $b }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($banners as $i => $item)
                <a href="{{ $item->link }}">
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <img width="1920" height="650" width="100%" {{ $i > 0 ? "loading=lazy" : '' }} src="{{ RvMedia::getImageUrl($item->image, 'large', false, RvMedia::getDefaultImage()) }}"
                            class="d-block" style="height: auto" alt="{{ $item->name }}">
                    </div>
                </a>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slideBanners" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slideBanners" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
