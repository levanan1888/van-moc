@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="tag-content">
                    <h1>{{ trans('plugins/ecommerce::products.tag') }}: {{ $tag->name }}</h1>
                    
                    <div class="tag-products">
                        @foreach ($products as $product)
                            <div class="product-item">
                                <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
                                @if ($product->image)
                                    <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $product->name }}">
                                @endif
                                <p>{{ Str::limit(clean($product->description), 200) }}</p>
                                <span class="price">{{ get_product_price($product) }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    {!! $products->links() !!}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="tag-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section> 