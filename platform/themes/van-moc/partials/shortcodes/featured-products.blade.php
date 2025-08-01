@php
    $title = $shortcode->title ?? 'SẢN PHẨM NỔI BẬT';
    $limit = $shortcode->limit ?? 8;
    
    // Lấy sản phẩm từ database
    if (class_exists('Botble\Ecommerce\Models\Product')) {
        $products = \Botble\Ecommerce\Models\Product::where('is_featured', 1)
            ->where('status', 'published')
            ->with(['slugable', 'categories', 'tags'])
            ->orderBy('order', 'asc')
            ->limit($limit)
            ->get();
    } elseif (function_exists('get_featured_products')) {
        $products = get_featured_products($limit);
    } else {
        // Fallback data nếu không có plugin ecommerce
        $products = collect([
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '179.660₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property11.png',
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property12.png',
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property13.png',
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property14.png',
                'url' => '#',
                'sale_percentage' => '10% OFF'
            ],
            (object)[
                'name' => 'Dầu gội kích thích mọc tóc thảo dược',
                'description' => 'GIẢM GÃY RỤNG - KÍCH THÍCH MỌ...',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => 'themes/van-moc/images/products/property15.png',
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa hạt cao cấp Forganic',
                'description' => 'DA DƯỠNG CHẤT - TĂNG ĐỀ KHÁNG',
                'price' => '683.000₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property16.png',
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Tắm & gội trẻ em Mộc Hương tinh dầu',
                'description' => 'AN TOÀN CHO BÉ - DỊU NHẸ',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => 'themes/van-moc/images/products/property17.png',
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa tắm tinh dầu thảo dược Mộc Hương',
                'description' => 'THƯ GIÃN - LÀM SẠCH DA',
                'price' => '284.000₫',
                'original_price' => null,
                'image' => 'themes/van-moc/images/products/property18.png',
                'url' => '#',
                'sale_percentage' => null
            ]
        ]);
    }
@endphp

<section class="featured-products" id="san-pham-noi-bat">
    <div class="container">
        <div class="section-header">
            <div class="title-wrapper">
                <h2>{{ $title }}</h2>
            </div>
            <div class="subtitle-wrapper">
                <a href="#" class="view-all">Xem tất cả sản phẩm <img src="{{ asset('themes/van-moc/images/button_arrow.svg') }}" alt="arrow"></a>
            </div>
        </div>
        
        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-item">
                        <div class="product-image">
                            @if (function_exists('RvMedia::getImageUrl'))
                                <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            @endif
                            @if (isset($product->sale_percentage) && $product->sale_percentage)
                                <div class="sale-badge">{{ $product->sale_percentage }}</div>
                            @elseif (method_exists($product, 'getSalePercentage') && $product->getSalePercentage() > 0)
                                <div class="sale-badge">Giảm {{ $product->getSalePercentage() }}%</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-text">
                                <h3>{{ $product->name }}</h3>
                                <p class="product-brand">{{ $product->description ?? $product->short_description ?? '' }}</p>
                                <div class="price-wrapper">
                                    @if (method_exists($product, 'getFrontSalePrice') && $product->getFrontSalePrice() != $product->getFrontBasePrice())
                                        <span class="original-price">{{ format_price($product->getFrontBasePrice()) }}</span>
                                    @endif
                                    <span class="price">{{ format_price($product->getFrontSalePrice()) }}</span>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <a href="{{ $product->url }}"><img src="{{ asset('themes/van-moc/images/icon_cart.svg') }}" alt="Add to cart"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>Chưa có sản phẩm nổi bật nào.</p>
            </div>
        @endif
    </div>
</section> 