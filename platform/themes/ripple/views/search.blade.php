@php Theme::set('section-name', __('Search result for: ') . ' "' . Request::input('q') . '"') @endphp
<div class="header-product-categories">
    <h3>{{ __('Search result for:') }} {{ Request::input('q') }}</h3>
</div>
<div class="mt-4 products">
    @if (!empty($products) && $products->count() > 0)
        <div class="row">
            @foreach ($products as $product)
                <div class="item col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="page-sidebar">
                        <div class="widget widget__recent-post">
                            <div class="widget__content widget__content__product">
                                @include('plugins/product::themes.pitem', ['none_contact' => 'Y'])
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="page-pagination d-flex align-items-center justify-content-center">
            {!! $products->withQueryString(['q' => Request::input('q')])->onEachSide(0)->links() !!}
        </div>
    @else
    <div class="ml-10">
        <p>{{ __('There is no data to display!') }}</p>
    </div>
    @endif
</div>
