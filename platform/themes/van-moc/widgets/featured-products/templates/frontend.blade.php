@php
    // Lấy sản phẩm từ database
    if (class_exists('Botble\Ecommerce\Models\Product')) {
        $products = \Botble\Ecommerce\Models\Product::where('is_featured', 1)
            ->where('status', 'published')
            ->with(['slugable', 'categories', 'tags'])
            ->orderBy('order', 'asc')
            ->limit($config['number_display'] ?? 4)
            ->get();
    } elseif (function_exists('get_featured_products')) {
        $products = get_featured_products($config['number_display'] ?? 4);
    } else {
        $products = collect();
    }
@endphp

@if ($products->count())
    <div class="widget widget__featured-products">
        <div class="widget__header">
            <div class="widget__title">{{ $config['name'] }}</div>
        </div>
        <div class="widget__content">
            <div class="products-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @if ($product->image)
                                <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $product->name }}">
                            @endif
                            <div class="add-to-cart">
                                <a href="{{ $product->url }}" class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                    <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart">
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p class="product-description">{{ Str::limit($product->description ?? $product->short_description ?? '', 50) }}</p>
                            <div class="product-price">
                                {{ get_product_price($product) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif 