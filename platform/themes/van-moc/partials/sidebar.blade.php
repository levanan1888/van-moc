<div class="sidebar">
    <div class="sidebar__widget">
        <h4 class="sidebar__widget-title">{{ trans('plugins/blog::base.recent_posts') }}</h4>
        <div class="sidebar__widget-content">
            @foreach (get_recent_posts(5) as $post)
                <div class="sidebar__widget-item">
                    <a href="{{ $post->url }}">{{ $post->name }}</a>
                    <span class="sidebar__widget-date">{{ $post->created_at->format('M d, Y') }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div> 