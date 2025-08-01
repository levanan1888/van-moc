<p class="search-result-title">{{ __('Search result') }}: </p>
@if (count($products) > 0)
    <div class="products">
        <div class="row">
            @foreach ($products as $product)
                <div class="item col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="page-sidebar">
                        <div class="widget widget__recent-post">
                            <div class="widget__content">
                                @include('plugins/product::themes.pitem', ['none_contact' => 'Y'  ])
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <p>{{ __('No result available for :name', ['name' => 'products']) }}</p>
@endif
