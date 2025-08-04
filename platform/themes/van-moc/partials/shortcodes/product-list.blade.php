@php
    $title = $shortcode->title ?? 'SẢN PHẨM NỔI BẬT';
    $limit = $shortcode->limit ?? 8;
    
    // Lấy sản phẩm từ database - giống như featured-products
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
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Nước dưỡng tóc tinh dầu bưởi 140ml',
                'description' => 'GIẢM GÃY RỤNG VÀ LÀM MỀM TÓC',
                'price' => '279.660₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => '10% OFF'
            ],
            (object)[
                'name' => 'Dầu gội kích thích mọc tóc thảo dược',
                'description' => 'GIẢM GÃY RỤNG - KÍCH THÍCH MỌ...',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => null,
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa hạt cao cấp Forganic',
                'description' => 'DA DƯỠNG CHẤT - TĂNG ĐỀ KHÁNG',
                'price' => '683.000₫',
                'original_price' => null,
                'image' => null,
                'url' => '#',
                'sale_percentage' => null
            ],
            (object)[
                'name' => 'Tắm & gội trẻ em Mộc Hương tinh dầu',
                'description' => 'AN TOÀN CHO BÉ - DỊU NHẸ',
                'price' => '162.000₫',
                'original_price' => '279.660₫',
                'image' => null,
                'url' => '#',
                'sale_percentage' => 'Giảm 40%'
            ],
            (object)[
                'name' => 'Sữa tắm tinh dầu thảo dược Mộc Hương',
                'description' => 'THƯ GIÃN - LÀM SẠCH DA',
                'price' => '284.000₫',
                'original_price' => null,
                'image' => null,
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
                <a href="#" class="view-all">Xem tất cả sản phẩm <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
            </div>
        </div>
        
        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-item">
                        <div class="product-image">
                            <a href="{{ $product->url }}">
                                @if ($product->image)
                                    <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                                @else
                                @if ($loop->index == 0)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 1)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property12.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 2)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property13.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 3)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property14.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 4)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property15.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 5)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property16.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 6)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property17.png') }}" alt="{{ $product->name }}">
                                @elseif ($loop->index == 7)
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property18.png') }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="{{ $product->name }}">
                                @endif
                            @endif
                            @if (isset($product->sale_percentage) && $product->sale_percentage)
                                <div class="sale-badge">{{ $product->sale_percentage }}</div>
                            @elseif (method_exists($product, 'getSalePercentage') && $product->getSalePercentage() > 0)
                                <div class="sale-badge">Giảm {{ $product->getSalePercentage() }}%</div>
                            @endif
                        </div>
                        <div class="product-info">
    <div class="product-text">
        <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>

        @if (!empty($product->description))
            <p class="product-brand">{{ Str::limit(strip_tags($product->description), 100) }}</p>
        @elseif (!empty($product->short_description))
            <p class="product-brand">{{ Str::limit(strip_tags($product->short_description), 100) }}</p>
        @endif

        <div class="price-wrapper">
            @if (!empty($product->original_price))
                <span class="original-price">{!! $product->original_price !!}</span>
            @endif
            <span class="price">{!! $product->price !!}</span>
        </div>
    </div>
</div>

                            </div>
                            <div class="add-to-cart">
                                <a href="{{ $product->url }}"><img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}" alt="Add to cart"></a>
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

<style>
.featured-products {
    padding: 80px 0;
    background: #fff;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
}

.title-wrapper h2 {
    font-size: 36px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.subtitle-wrapper .view-all {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.3s ease;
}

.subtitle-wrapper .view-all:hover {
    color: #218838;
}

.subtitle-wrapper .view-all img {
    width: 20px;
    height: 20px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.product-item {
    background: white;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.product-item:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.product-image {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-item:hover .product-image img {
    transform: scale(1.05);
}

.sale-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #dc3545;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
}

.product-info {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 15px;
}

.product-text {
    flex: 1;
}

.product-text h3 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 8px 0;
    line-height: 1.4;
}

.product-text h3 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-text h3 a:hover {
    color: #28a745;
}

.product-brand {
    font-size: 12px;
    color: #666;
    margin: 0 0 12px 0;
    line-height: 1.3;
}

.price-wrapper {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.original-price {
    font-size: 14px;
    color: #999;
    text-decoration: line-through;
}

.price {
    font-size: 18px;
    font-weight: 700;
    color: #28a745;
}

.add-to-cart {
    flex-shrink: 0;
}

.add-to-cart a {
    display: block;
    width: 40px;
    height: 40px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.add-to-cart a:hover {
    background: #218838;
    transform: scale(1.1);
}

.add-to-cart img {
    width: 20px;
    height: 20px;
    filter: brightness(0) invert(1);
}

.no-products {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

/* Responsive */
@media (max-width: 991px) {
    .featured-products {
        padding: 60px 0;
    }
    
    .section-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .title-wrapper h2 {
        font-size: 28px;
    }
    
    .product-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .featured-products {
        padding: 40px 0;
    }
    
    .title-wrapper h2 {
        font-size: 24px;
    }
    
    .product-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }
    
    .product-image {
        height: 220px;
    }
    
    .product-info {
        padding: 15px;
    }
    
    .product-text h3 {
        font-size: 14px;
    }
    
    .price {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .product-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .product-image {
        height: 200px;
    }
    
    .product-info {
        padding: 12px;
    }
    
    .add-to-cart a {
        width: 35px;
        height: 35px;
    }
    
    .add-to-cart img {
        width: 18px;
        height: 18px;
    }
}
</style>

<script>
// Add to cart functionality
document.querySelectorAll('.add-to-cart a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const productItem = this.closest('.product-item');
        const productName = productItem.querySelector('h3').textContent;
        alert(`Đã thêm "${productName}" vào giỏ hàng!`);
    });
});

// Product item click to go to detail page
document.querySelectorAll('.product-item').forEach(item => {
    item.addEventListener('click', function(e) {
        // Don't trigger if clicking on add to cart button
        if (!e.target.closest('.add-to-cart')) {
            const productLink = this.querySelector('.product-image img').closest('a') || 
                               this.querySelector('.product-text h3').closest('a');
            if (productLink) {
                window.location.href = productLink.href;
            }
        }
    });
});
</script> 