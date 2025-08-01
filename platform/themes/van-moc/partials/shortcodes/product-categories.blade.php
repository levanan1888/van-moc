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
                'image' => 'themes/van-moc/images/categories/srisri.png',
                'url' => '#',
                'products_count' => 15
            ],
            (object)[
                'name' => 'MỘC HƯƠNG',
                'description' => 'Sản phẩm tinh dầu thảo dược',
                'image' => 'themes/van-moc/images/categories/moc-huong.png',
                'url' => '#',
                'products_count' => 12
            ],
            (object)[
                'name' => 'BRANDS\'',
                'description' => 'Thương hiệu cao cấp',
                'image' => 'themes/van-moc/images/categories/brands.png',
                'url' => '#',
                'products_count' => 8
            ],
            (object)[
                'name' => 'FORGANIC',
                'description' => 'Sản phẩm hữu cơ tự nhiên',
                'image' => 'themes/van-moc/images/categories/forganic.png',
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
                        @if (function_exists('RvMedia::getImageUrl'))
                            <img src="{{ RvMedia::getImageUrl($category->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
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