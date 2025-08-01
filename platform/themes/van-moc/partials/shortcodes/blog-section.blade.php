@php
    $title = $shortcode->title ?? 'BLOG LÀM ĐẸP TỰ NHIÊN';
    $limit = $shortcode->limit ?? 4;
    
    // Lấy bài viết từ database
    if (class_exists('Botble\Blog\Models\Post')) {
        $posts = \Botble\Blog\Models\Post::where('status', 'published')
            ->with(['slugable', 'categories', 'author'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    } elseif (function_exists('get_recent_posts')) {
        $posts = get_recent_posts($limit);
    } else {
        // Fallback data nếu không có plugin blog
        $posts = collect([
            (object)[
                'name' => 'Chăm sóc da cho anh ấy: Quà tặng chu đáo',
                'description' => 'Chăm sóc da cho anh ấy: Quà tặng chu đáo. Da nhạy cảm...',
                'image' => 'themes/van-moc/images/blog/libary1.png',
                'url' => '#',
                'author' => (object)['name' => 'Vạn Mộc'],
                'created_at' => now()->subDays(5),
                'categories' => collect([(object)['name' => 'Chăm sóc']])
            ],
            (object)[
                'name' => 'Quy trình chăm sóc da tối ưu cho làn da nhạy cảm',
                'description' => 'Da nhạy cảm không phải là điều tồi tệ. Chăm sóc da...',
                'image' => 'themes/van-moc/images/blog/libary2.png',
                'url' => '#',
                'author' => (object)['name' => 'Vạn Mộc'],
                'created_at' => now()->subDays(3),
                'categories' => collect([(object)['name' => 'Làm đẹp']])
            ],
            (object)[
                'name' => 'Mọi thứ bạn muốn biết về chăm sóc da thời kỳ mãn kinh',
                'description' => 'Chăm sóc da cho anh ấy: Quà tặng chu đáo...',
                'image' => 'themes/van-moc/images/blog/libary3.png',
                'url' => '#',
                'author' => (object)['name' => 'Vạn Mộc'],
                'created_at' => now()->subDays(1),
                'categories' => collect([(object)['name' => 'Đời sống']])
            ],
            (object)[
                'name' => 'Hướng dẫn tối ưu về việc làm sạch lớp',
                'description' => 'Việc sử dụng sữa rửa mặt đúng cách...',
                'image' => 'themes/van-moc/images/blog/libary4.png',
                'url' => '#',
                'author' => (object)['name' => 'Vạn Mộc'],
                'created_at' => now(),
                'categories' => collect([(object)['name' => 'Review']])
            ]
        ]);
    }
@endphp

<section class="blog">
    <div class="container">
        <div class="section-header">
            <h2>{{ $title }}</h2>
            <div class="view-all-wrapper">
                <a href="#" class="view-all">Xem tất cả <img src="{{ asset('themes/van-moc/images/button_arrow.svg') }}" alt="arrow"></a>
            </div>
        </div>
        
        @if ($posts->count())
            <div class="blog-grid">
                @foreach ($posts as $post)
                    <div class="blog-post">
                        <div class="product-image">
                            <div class="blog-tag">{{ $post->categories->first()->name ?? 'Chăm sóc' }}</div>
                            @if (function_exists('RvMedia::getImageUrl'))
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}">
                            @else
                                <img src="{{ asset($post->image) }}" alt="{{ $post->name }}">
                            @endif
                        </div>
                        <div class="blog-content">
                            <h3>{{ $post->name }}</h3>
                            <p>{{ Str::limit($post->description, 100) }}</p>
                            <div class="post-meta">
                                <span>Bởi {{ $post->author->name ?? 'Vạn Mộc' }}</span> - <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                            <a href="{{ $post->url }}" class="read-more">ĐỌC NGAY <img src="{{ asset('themes/van-moc/images/button_docngay.svg') }}" alt="arrow"></a>
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