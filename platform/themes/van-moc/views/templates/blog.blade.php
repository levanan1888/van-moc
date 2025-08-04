@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<!-- Hero Banner Section -->
<section class="hero-banner-section">
    <div class="hero-banner">
        <div class="hero-banner__background">
            <img src="{{ RvMedia::getImageUrl(theme_option('blog_banner_image', 'test/VMM_HOMEPAGE.jpg')) }}" alt="Blog Banner">
        </div>
        <div class="hero-banner__content">
            <div class="container">
                <div class="hero-banner__text">
                    <h1 class="hero-banner__slogan">Từ thành phần đến trải nghiệm – hiểu sâu hơn về từng sản phẩm bạn đang dùng.</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Blog Section -->
<section class="blog-main-section">
    <div class="container">
        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <div class="blog-main-content">
                    <h2 class="blog-main-title">Blog</h2>
                    
                    <div class="blog-posts-grid">
                        @foreach ($posts as $post)
                            <article class="blog-post-card">
                                <div class="blog-post-card__image">
                                    <a href="{{ $post->url }}">
                                        <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" 
                                             alt="{{ $post->name }}" loading="lazy">
                                    </a>
                                    @if ($post->categories->count() > 0)
                                        <div class="blog-post-card__category">
                                            <span>{{ $post->categories->first()->name }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="blog-post-card__content">
                                    <h3 class="blog-post-card__title">
                                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                                    </h3>
                                    
                                    <div class="blog-post-card__excerpt">
                                        <p>{{ Str::limit(clean($post->description), 120) }}</p>
                                    </div>
                                    
                                    <div class="blog-post-card__meta">
                                        <span class="blog-post-card__date">{{ $post->created_at->format('d/m/Y') }}</span>
                                        <span class="blog-post-card__read-time">2 phút đọc</span>
                                        <span class="blog-post-card__views">{{ number_format($post->views ?? rand(1000, 5000)) }} lượt xem</span>
                                    </div>
                                    
                                    <div class="blog-post-card__action">
                                        <a href="{{ $post->url }}" class="blog-post-card__read-more">
                                            ĐỌC NGAY -
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="blog-pagination">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- VẠN MỘC MALL Widget -->
                    <div class="sidebar-widget sidebar-widget--brand">
                        <div class="sidebar-widget__content">
                            <div class="brand-info">
                                <div class="brand-info__logo">
                                    <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="VẠN MỘC MALL">
                                </div>
                                <h3 class="brand-info__title">VẠN MỘC MALL</h3>
                                <p class="brand-info__description">
                                    Chúng tôi cam kết mang đến những sản phẩm chăm sóc da tự nhiên, 
                                    sức khỏe và các sản phẩm thảo dược chất lượng cao.
                                </p>
                                <div class="brand-info__social">
                                    <h4>Theo dõi chúng tôi:</h4>
                                    <div class="social-links">
                                        <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blog Categories Widget -->
                    <div class="sidebar-widget sidebar-widget--categories">
                        <h4 class="sidebar-widget__title">Danh mục blog</h4>
                        <div class="sidebar-widget__content">
                            <div class="blog-categories-grid">
                                @foreach (get_all_categories() as $cat)
                                    <a href="{{ $cat->url }}" class="blog-category-item">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Popular Posts Widget -->
                    <div class="sidebar-widget sidebar-widget--popular">
                        <h4 class="sidebar-widget__title">Phổ biến nhất</h4>
                        <div class="sidebar-widget__content">
                            @foreach (get_popular_posts(5) as $popularPost)
                                <div class="popular-post-item">
                                    <div class="popular-post-item__image">
                                        <a href="{{ $popularPost->url }}">
                                            <img src="{{ RvMedia::getImageUrl($popularPost->image, 'thumb', false, RvMedia::getDefaultImage()) }}" 
                                                 alt="{{ $popularPost->name }}">
                                        </a>
                                    </div>
                                    <div class="popular-post-item__content">
                                        <h5 class="popular-post-item__title">
                                            <a href="{{ $popularPost->url }}">{{ Str::limit($popularPost->name, 50) }}</a>
                                        </h5>
                                        <div class="popular-post-item__meta">
                                            <span class="popular-post-item__date">{{ $popularPost->created_at->format('d/m/Y') }}</span>
                                            <span class="popular-post-item__views">{{ number_format($popularPost->views ?? rand(1000, 5000)) }} lượt xem</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 