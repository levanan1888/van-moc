@php Theme::set('section-name', $category->name) @endphp
<div class="header-product-categories">
    <h1>{{ $category->name }}</h1>
</div>
<div class="row mt-2 products">
    @if (!empty($categories))
        <div class="col-lg-3 col-md-12 col-sm-12 col-12 menus mb-4 d-md-block d-none">
            <div class="page-sidebar">
                <div class="widget widget__recent-post">
                    <div class="widget__content widget__content__menu">
                        <div class="accordion trees-categories" id="menuAccordions">
                            @foreach ($categories as $one)
                            <div class="accordion-item">
                                <div class="accordion-header d-flex justify-content-between" id="section-{{ $one->id }}">
                                    <a class="link {{ $category->slug == $one->slug ? 'actived' : '' }}" href="{{ $one->url }}" class="accordion-link"><strong>{{ Str::upper($one->name) }}</strong></a>
                                    @if (!empty($one->children))
                                    <a href="#" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $one->id }}"></a>
                                    @endif
                                </div>
                                <div id="collapse-{{ $one->id }}" class="accordion-collapse collapse show" aria-labelledby="section-{{ $one->id }}">
                                    @if (!empty($one->children))
                                    <div class="accordion-bd">
                                        @foreach($one->children as $two)
                                            <div class="accordion-item">
                                                <div class="accordion-header d-flex justify-content-between" id="section-{{ $two->id }}">
                                                    <a class="link {{ $category->slug == $two->slug ? 'actived' : '' }}" href="{{ $two->url }}" class="accordion-link"><span class="{{ !empty($two->children) ? 'title-bolder' : '' }}">{{ $two->name }}</span></a>
                                                    @if (!empty($two->children))
                                                    <a href="#" class="accordion-button accordion-button-2" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $two->id }}" aria-expanded="false"></a>
                                                    @endif
                                                </div>
                                                <div id="collapse-{{ $two->id }}" class="accordion-collapse collapse collapse-2 show" aria-labelledby="section-{{ $two->id }}">
                                                    @if (!empty($two->children))
                                                    <div class="accordion-bd">
                                                        @foreach($two->children as $tree)
                                                        <div class="accordion-item">
                                                            <div class="accordion-header d-flex justify-content-between" id="section-{{ $tree->id }}">
                                                                <a class="link {{ $category->slug == $tree->slug ? 'actived' : '' }}" href="{{ $tree->url }}" class="accordion-link">{{ $tree->name }}</a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-9 col-md-12 col-sm-12 col-12 items">
        @if ($products->count() > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="item col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                        <div class="page-sidebar">
                            <div class="widget widget__recent-post">
                                <div class="widget__content widget__content__product">
                                    @include('plugins/product::themes.pitem')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="page-pagination d-flex align-items-center justify-content-center">
                {!! $products->onEachSide(0)->links() !!}
            </div>
        @else
        <div class="ml-10">
            <p>{{ __('There is no data to display!') }}</p>
        </div>
        @endif
    </div>
</div>
@if(!empty($category->description) && strlen($category->description) > 31)
<div class="page-sidebar mt-5">
    <div class="widget widget__recent-post">
        <div id="category-content" class="widget__content widget__content__product">
            <div class="footer-product-categories">
                <div style="display: none" id="loadMoreCategoryContent" class="desc read-more">{!! str_replace('<img', '<img loading="lazy"', $category->description); !!}</div>
            </div>
        </div>
    </div>
</div>
@endif

@include(Theme::getThemeNamespace() . '::views.contact-form', [])
