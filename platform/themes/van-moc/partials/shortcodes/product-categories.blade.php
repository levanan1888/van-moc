@php
    $title = $shortcode->title ?? 'DANH MỤC SẢN PHẨM';
    $limit = $shortcode->limit ?? 4;
    
    // Lấy danh mục từ database
    if (class_exists('Botble\Ecommerce\Models\ProductCategory')) {
        $categories = \Botble\Ecommerce\Models\ProductCategory::where('status', 'published')
            ->with(['slugable', 'products'])
            ->orderBy('order', 'asc')
            ->limit($limit)
            ->get();
    } elseif (function_exists('get_product_categories')) {
        $categories = get_product_categories($limit);
    } else {
        // Fallback data nếu không có plugin ecommerce
        $categories = collect([
            (object)[
                'name' => 'SRISRI',
                'description' => 'Thương hiệu chăm sóc tóc tự nhiên',
                'image' => null,
                'url' => '#',
                'products_count' => 15
            ],
            (object)[
                'name' => 'MỘC HƯƠNG',
                'description' => 'Sản phẩm tinh dầu thảo dược',
                'image' => null,
                'url' => '#',
                'products_count' => 12
            ],
            (object)[
                'name' => 'BRANDS\'',
                'description' => 'Thương hiệu cao cấp',
                'image' => null,
                'url' => '#',
                'products_count' => 8
            ],
            (object)[
                'name' => 'FORGANIC',
                'description' => 'Sản phẩm hữu cơ tự nhiên',
                'image' => null,
                'url' => '#',
                'products_count' => 20
            ]
        ]);
    }
@endphp

<section class="categories">
    <div class="container">
        <div class="section-header">
            <h2>{{ $title }}</h2>
        </div>
        
        @if ($categories->count())
            <div class="category-grid">
                @foreach ($categories as $category)
                    <div class="category-item">
                        @if ($category->image)
                            <img src="{{ RvMedia::getImageUrl($category->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $category->name }}">
                        @else
                            @if ($loop->index == 0)
                                <img src="{{ asset('themes/van-moc/images/category-homepage/srisri.png') }}" alt="{{ $category->name }}">
                            @elseif ($loop->index == 1)
                                <img src="{{ asset('themes/van-moc/images/category-homepage/moc-huong.png') }}" alt="{{ $category->name }}">
                            @elseif ($loop->index == 2)
                                <img src="{{ asset('themes/van-moc/images/category-homepage/brands.png') }}" alt="{{ $category->name }}">
                            @elseif ($loop->index == 3)
                                <img src="{{ asset('themes/van-moc/images/category-homepage/forganic.png') }}" alt="{{ $category->name }}">
                            @else
                                <img src="{{ RvMedia::getImageUrl(RvMedia::getDefaultImage(), 'medium') }}" alt="{{ $category->name }}">
                            @endif
                        @endif
                        <div class="category-info">
                            <h3>{{ $category->name }}</h3>
                            @if (isset($category->description) && $category->description)
                                <p>{{ $category->description }}</p>
                            @elseif (method_exists($category, 'getProductsCount'))
                                <p>{{ $category->getProductsCount() }} sản phẩm</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-categories">
                <p>Chưa có danh mục sản phẩm nào.</p>
            </div>
        @endif
    </div>
</section>

<style>
/* Categories Section */
.categories {
    padding: 80px 0;
}

.categories .section-header h2 {
    font-family: 'Prata', serif;
    font-size: 28px;
    text-align: center;
    position: relative;
    margin: 0;
    padding-bottom: 10px;
}

.categories .section-header h2:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background-color: #4A7D4A;
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-top: 40px;
}

.category-item {
    text-align: center;
}

.category-item img {
    width: 100%;
    display: block;
    border-radius: 5px;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.category-item img:hover {
    transform: scale(1.05);
}

.category-item h3 {
    font-size: 22px;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 1200px) {
    .category-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .category-grid {
        grid-template-columns: 1fr;
    }
}
</style> 