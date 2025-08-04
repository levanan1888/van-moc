@php
    $posts = get_popular_posts(12);
    $categories = get_all_categories();
    $currentCategory = request()->get('category', 'all');
@endphp

<!-- Blog Hero Banner -->
<section class="blog-hero-banner">
    <div class="hero-image">
        <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_blog(2)/banner.png') }}" alt="Blog Banner">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-quote">"Từ thành phần đến trải nghiệm – hiểu sâu hơn về từng sản phẩm bạn đang dùng."</h1>
            </div>
        </div>
    </div>
</section>

<!-- Category Navigation -->
<section class="blog-category-nav">
    <div class="container">
        <div class="category-tabs">
            <button class="category-tab {{ $currentCategory == 'all' ? 'active' : '' }}" data-category="all">
                Tất cả
            </button>
            @foreach($categories as $category)
                <button class="category-tab {{ $currentCategory == $category->slug ? 'active' : '' }}" data-category="{{ $category->slug }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Main Blog Section -->
<section class="blog-main-section">
    <div class="container">
        <div class="blog-layout">
            <!-- Main Content -->
            <div class="blog-content">
                <div class="blog-header">
                    <h2 class="blog-title">Blog</h2>
                    <div class="blog-controls">
                        <div class="sort-controls">
                            <select class="sort-select" id="sortPosts">
                                <option value="latest">Mới nhất</option>
                                <option value="popular">Được xem nhiều nhất</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Blog Posts Grid -->
                <div class="blog-posts-grid" id="blogPostsGrid">
                    @foreach($posts as $post)
                        <article class="blog-post-card" data-category="{{ $post->categories->first()->slug ?? 'uncategorized' }}">
                            <div class="post-image">
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" 
                                     alt="{{ $post->name }}" 
                                     loading="lazy">
                                @if($post->categories->count() > 0)
                                    <div class="category-tag">
                                        {{ $post->categories->first()->name }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a href="{{ $post->url }}">{{ $post->name }}</a>
                                </h3>
                                
                                <p class="post-excerpt">
                                    {{ Str::limit($post->description, 120) }}
                                </p>
                                
                                <div class="post-meta">
                                    <span class="post-date">{{ $post->created_at->format('d/m/Y') }}</span>
                                    <span class="post-read-time">2 phút đọc</span>
                                    <span class="post-views">{{ number_format($post->views ?? rand(1000, 5000)) }} lượt xem</span>
                                </div>
                                
                                <a href="{{ $post->url }}" class="read-more-btn">
                                    ĐỌC NGAY →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="blog-pagination">
                    <button class="pagination-btn prev" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="pagination-numbers">
                        <button class="pagination-number active">1</button>
                        <button class="pagination-number">2</button>
                        <button class="pagination-number">3</button>
                        <button class="pagination-number">4</button>
                        <button class="pagination-number">5</button>
                    </div>
                    <button class="pagination-btn next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="blog-sidebar">
                <!-- Popular Posts -->
                <div class="sidebar-widget popular-posts">
                    <h3 class="widget-title">Phổ biến nhất</h3>
                    <div class="popular-posts-list">
                        @foreach(array_slice($posts->toArray(), 0, 5) as $popularPost)
                            <div class="popular-post-item">
                                <div class="popular-post-image">
                                    <img src="{{ RvMedia::getImageUrl($popularPost['image'], 'thumb', false, RvMedia::getDefaultImage()) }}" 
                                         alt="{{ $popularPost['name'] }}">
                                </div>
                                <div class="popular-post-content">
                                    <h4 class="popular-post-title">
                                        <a href="{{ $popularPost['url'] }}">{{ Str::limit($popularPost['name'], 50) }}</a>
                                    </h4>
                                    <span class="popular-post-views">{{ number_format($popularPost['views'] ?? rand(2000, 8000)) }} lượt xem</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="sidebar-widget image-gallery">
                    <h3 class="widget-title">Thư viện ảnh</h3>
                    <div class="gallery-grid">
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_blog(2)/libary1.png') }}" alt="Gallery Image">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh_blog(2)/libary2.png') }}" alt="Gallery Image">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property11.png') }}" alt="Gallery Image">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property12.png') }}" alt="Gallery Image">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property13.png') }}" alt="Gallery Image">
                        </div>
                        <div class="gallery-item">
                            <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/hinh product/property14.png') }}" alt="Gallery Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Blog Hero Banner */
.blog-hero-banner {
    position: relative;
    height: 400px;
    overflow: hidden;
    margin-bottom: 40px;
}

.hero-image {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-content {
    text-align: center;
    color: white;
    max-width: 800px;
    padding: 0 20px;
}

.hero-quote {
    font-family: 'Prata', serif;
    font-size: 32px;
    font-weight: 400;
    line-height: 1.4;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

/* Category Navigation */
.blog-category-nav {
    background: #f8f9fa;
    padding: 20px 0;
    margin-bottom: 40px;
}

.category-tabs {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding: 0 20px;
}

.category-tab {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    flex-shrink: 0;
}

.category-tab:hover,
.category-tab.active {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

/* Blog Layout */
.blog-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    align-items: start;
}

/* Blog Content */
.blog-content {
    min-height: 500px;
}

.blog-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.blog-title {
    font-family: 'Prata', serif;
    font-size: 28px;
    font-weight: 400;
    color: #333;
    margin: 0;
}

.sort-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sort-select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    background: white;
}

/* Blog Posts Grid */
.blog-posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

.blog-post-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.post-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-post-card:hover .post-image img {
    transform: scale(1.05);
}

.category-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(40, 167, 69, 0.9);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
}

.post-content {
    padding: 20px;
}

.post-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.4;
}

.post-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: #28a745;
}

.post-excerpt {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin: 0 0 15px 0;
}

.post-meta {
    display: flex;
    gap: 15px;
    font-size: 12px;
    color: #999;
    margin-bottom: 15px;
}

.read-more-btn {
    display: inline-block;
    background: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.3s ease;
}

.read-more-btn:hover {
    background: #218838;
    color: white;
}

/* Pagination */
.blog-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 40px;
}

.pagination-btn {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pagination-btn:hover:not(:disabled) {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-numbers {
    display: flex;
    gap: 5px;
}

.pagination-number {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.pagination-number:hover,
.pagination-number.active {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

/* Sidebar */
.blog-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.widget-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

/* Popular Posts */
.popular-posts-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.popular-post-item {
    display: flex;
    gap: 12px;
    align-items: center;
}

.popular-post-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.popular-post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popular-post-content {
    flex: 1;
    min-width: 0;
}

.popular-post-title {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 5px 0;
    line-height: 1.4;
}

.popular-post-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.popular-post-title a:hover {
    color: #28a745;
}

.popular-post-views {
    font-size: 12px;
    color: #999;
}

/* Image Gallery */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.gallery-item {
    aspect-ratio: 1;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .blog-layout {
        grid-template-columns: 1fr 280px;
        gap: 30px;
    }
    
    .blog-posts-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
}

@media (max-width: 991px) {
    .blog-layout {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .blog-sidebar {
        position: static;
        order: 2;
    }
    
    .blog-content {
        order: 1;
    }
    
    .hero-quote {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .blog-hero-banner {
        height: 300px;
    }
    
    .hero-quote {
        font-size: 24px;
    }
    
    .blog-posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .category-tabs {
        gap: 10px;
        padding: 0 15px;
    }
    
    .category-tab {
        padding: 10px 20px;
        font-size: 13px;
    }
    
    .blog-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .sidebar-widget {
        padding: 20px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 480px) {
    .blog-hero-banner {
        height: 250px;
    }
    
    .hero-quote {
        font-size: 20px;
    }
    
    .category-tabs {
        gap: 8px;
        padding: 0 10px;
    }
    
    .category-tab {
        padding: 8px 16px;
        font-size: 12px;
    }
    
    .post-content {
        padding: 15px;
    }
    
    .post-title {
        font-size: 16px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filtering
    const categoryTabs = document.querySelectorAll('.category-tab');
    const blogPosts = document.querySelectorAll('.blog-post-card');
    
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Filter posts
            blogPosts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });
    
    // Sort functionality
    const sortSelect = document.getElementById('sortPosts');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const postsGrid = document.getElementById('blogPostsGrid');
            const posts = Array.from(postsGrid.children);
            
            // Simple sorting logic (in real implementation, this would be server-side)
            if (sortBy === 'popular') {
                posts.sort((a, b) => {
                    const viewsA = parseInt(a.querySelector('.post-views').textContent.replace(/[^\d]/g, ''));
                    const viewsB = parseInt(b.querySelector('.post-views').textContent.replace(/[^\d]/g, ''));
                    return viewsB - viewsA;
                });
            } else {
                posts.sort((a, b) => {
                    const dateA = new Date(a.querySelector('.post-date').textContent);
                    const dateB = new Date(b.querySelector('.post-date').textContent);
                    return dateB - dateA;
                });
            }
            
            // Re-append sorted posts
            posts.forEach(post => postsGrid.appendChild(post));
        });
    }
    
    // Pagination functionality
    const paginationNumbers = document.querySelectorAll('.pagination-number');
    const prevBtn = document.querySelector('.pagination-btn.prev');
    const nextBtn = document.querySelector('.pagination-btn.next');
    
    paginationNumbers.forEach(number => {
        number.addEventListener('click', function() {
            paginationNumbers.forEach(n => n.classList.remove('active'));
            this.classList.add('active');
            
            // Update prev/next buttons
            const currentPage = parseInt(this.textContent);
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === paginationNumbers.length;
        });
    });
    
    // Gallery lightbox effect (simple version)
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            // In a real implementation, you'd open a lightbox here
            console.log('Gallery image clicked:', img.src);
        });
    });
});
</script> 