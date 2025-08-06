@php Theme::layout('default'); @endphp

@push('header')
    <link rel="stylesheet" href="{{ asset('themes/van-moc/css/product-category.css') }}">
@endpush

{!! Theme::partial('breadcrumbs') !!}

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="category-content">
                    <div class="category-header">
                        <h1 class="category-content__name">{{ $category->name }}</h1>
                        <div class="category-filters">
                            <div class="filter-dropdown">
                                <span class="filter-label">96 Lọc</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="sort-dropdown">
                                <span class="sort-label">Sắp xếp</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="category-products grid-products">
                        @foreach ($products as $product)
                            <div class="product-item">
                                <div class="product-image">
                                    <a href="{{ $product->url }}">
                                        <img
                                            src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <div class="product-text">
                                        <h5><a href="{{ $product->url }}">{{ $product->name }}</a></h5>
                                        <p class="product-description">{{ Str::limit(clean($product->description), 200) }}</p>
                                        <span class="price">{{ number_format($product->price) }}₫</span>
                                    </div>
                                    <div class="add-to-cart">
                                        <button type="button" class="btn-add-to-cart-featured" title="Thêm vào giỏ hàng">
                                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_cart.svg') }}"
                                                alt="Add to cart">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="load-more-section">
                        <button class="btn-load-more">XEM THÊM SẢN PHẨM</button>
                    </div>

                    {!! $products->links() !!}
                </div>
            </div>
                <div class="col-lg-3">
                    <div class="category-sidebar">
                        {!! Theme::partial('sidebar') !!}
                    </div>
                </div>
        </div>
    </div>
</section>
<!-- Services/Benefits Section -->
<section class="services-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="services-grid">
                    <div class="service-item">
                        <div class="service-icon">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_shipping.svg') }}" alt="Free shipping">
                        </div>
                        <div class="service-content">
                            <h4 class="service-title">Miễn phí vận chuyển</h4>
                            <p class="service-description">Miễn phí vận chuyển cho đơn hàng từ 500.000₫</p>
                        </div>
                    </div>

                    <div class="service-item">
                        <div class="service-icon">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_quality.svg') }}" alt="Quality assurance">
                        </div>
                        <div class="service-content">
                            <h4 class="service-title">Đảm bảo chất lượng</h4>
                            <p class="service-description">100% sản phẩm chính hãng, có giấy tờ đầy đủ</p>
                        </div>
                    </div>

                    <div class="service-item">
                        <div class="service-icon">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_delivery.svg') }}" alt="Nationwide delivery">
                        </div>
                        <div class="service-content">
                            <h4 class="service-title">Giao hàng toàn quốc</h4>
                            <p class="service-description">Giao hàng nhanh chóng đến mọi tỉnh thành</p>
                        </div>
                    </div>

                    <div class="service-item">
                        <div class="service-icon">
                            <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/icon_support.svg') }}" alt="24/7 Support">
                        </div>
                        <div class="service-content">
                            <h4 class="service-title">Hỗ trợ 24/7</h4>
                            <p class="service-description">Đội ngũ tư vấn chuyên nghiệp, sẵn sàng hỗ trợ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('footer')
    <script src="{{ asset('themes/van-moc/js/product-category.js') }}"></script>
@endpush

