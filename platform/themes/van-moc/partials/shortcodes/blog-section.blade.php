@php
    $title = $shortcode->title ?? 'BLOG LÀM ĐẸP TỰ NHIÊN';
    $limit = $shortcode->limit ?? 4;
    
    // Sử dụng data cứng thay vì database
    $posts = collect([
        (object)[
            'name' => 'Chăm sóc da cho anh ấy: Quà tặng chu đáo',
            'description' => 'Chăm sóc da cho anh ấy: Quà tặng chu đáo. Da nhạy cảm cần được chăm sóc đặc biệt với các sản phẩm tự nhiên.',
            'image' => null,
            'url' => '#',
            'author' => (object)['name' => 'Vạn Mộc'],
            'created_at' => now()->subDays(5),
            'categories' => collect([(object)['name' => 'Chăm sóc']])
        ],
        (object)[
            'name' => 'Quy trình chăm sóc da tối ưu cho làn da nhạy cảm',
            'description' => 'Da nhạy cảm không phải là điều tồi tệ. Chăm sóc da đúng cách với thảo dược tự nhiên sẽ giúp da khỏe mạnh.',
            'image' => null,
            'url' => '#',
            'author' => (object)['name' => 'Vạn Mộc'],
            'created_at' => now()->subDays(3),
            'categories' => collect([(object)['name' => 'Làm đẹp']])
        ],
        (object)[
            'name' => 'Mọi thứ bạn muốn biết về chăm sóc da thời kỳ mãn kinh',
            'description' => 'Chăm sóc da cho phụ nữ trung niên với các sản phẩm tự nhiên giúp duy trì vẻ đẹp và sự trẻ trung.',
            'image' => null,
            'url' => '#',
            'author' => (object)['name' => 'Vạn Mộc'],
            'created_at' => now()->subDays(1),
            'categories' => collect([(object)['name' => 'Đời sống']])
        ],
        (object)[
            'name' => 'Hướng dẫn tối ưu về việc làm sạch da',
            'description' => 'Việc sử dụng sữa rửa mặt đúng cách với các thành phần tự nhiên sẽ giúp da sạch và khỏe mạnh.',
            'image' => null,
            'url' => '#',
            'author' => (object)['name' => 'Vạn Mộc'],
            'created_at' => now(),
            'categories' => collect([(object)['name' => 'Review']])
        ]
    ]);
@endphp
@endphp

<section class="blog">
    <div class="container">
        <div class="section-header">
            <h2>{{ $title }}</h2>
            <div class="view-all-wrapper">
                <a href="#" class="view-all">Xem tất cả <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_arrow.svg') }}" alt="arrow"></a>
            </div>
        </div>
        
        @if ($posts->count())
            <div class="blog-grid">
                @foreach ($posts as $post)
                    <div class="blog-post">
                        <div class="product-image">
                            <div class="blog-tag">{{ $post->categories->first()->name ?? 'Chăm sóc' }}</div>
                            @if ($loop->index == 0)
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/background1.png') }}" alt="{{ $post->name }}">
                            @elseif ($loop->index == 1)
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/frame604.png') }}" alt="{{ $post->name }}">
                            @elseif ($loop->index == 2)
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/background4.png') }}" alt="{{ $post->name }}">
                            @elseif ($loop->index == 3)
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/background5.png') }}" alt="{{ $post->name }}">
                            @else
                                <img src="{{ asset('themes/van-moc/images/VMM_image/VMM_image/background6.png') }}" alt="{{ $post->name }}">
                            @endif
                        </div>
                        <div class="blog-content">
                            <h3>{{ $post->name }}</h3>
                            <p>{{ Str::limit($post->description, 100) }}</p>
                            <div class="post-meta">
                                <span>Bởi {{ $post->author->name ?? 'Vạn Mộc' }}</span> - <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                            <a href="{{ $post->url }}" class="read-more">ĐỌC NGAY <img src="{{ asset('themes/van-moc/images/VMM_ICON/VMM_ICON/button_docngay.svg') }}" alt="arrow"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-posts">
                <p>Chưa có bài viết nào.</p>
            </div>
        @endif
    </div>
</section>

<style>
/* Blog Section */
.blog {
    padding: 80px 0;
    background-color: #F9F9F9;
}

.blog .section-header h2 {
    font-family: 'Prata', serif;
    font-size: 28px;
    text-align: center;
    position: relative;
    margin: 0 auto;
    padding-bottom: 10px;
}

.blog .section-header {
    margin-bottom: 40px;
    text-align: center;
}

.blog .view-all {
    justify-content: center;
    margin-top: 10px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 5px;
}

.blog-post {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
}

.blog-post .product-image {
    height: 400px;
    overflow: hidden;
    position: relative;
}

.blog-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: rgba(255,255,255,0.8);
    backdrop-filter: blur(5px);
    color: #333;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 500;
    border-radius: 20px;
    z-index: 2;
}

.post-meta {
    font-size: 12px;
    color: #777;
    margin-bottom: 30px;
}

.blog-post .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.blog-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.blog-post h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
    flex-grow: 1;
}

.blog-post p {
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
    font-size: 14px;
}

.read-more {
    font-weight: 600;
    color: #4A7D4A;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
    font-size: 14px;
}

.read-more img {
    width: 18px;
}

/* Responsive */
@media (max-width: 1200px) {
    .blog-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .blog-grid {
        grid-template-columns: 1fr;
    }
}
</style> 