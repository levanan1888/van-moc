<?php

if (!function_exists('get_all_categories')) {
    function get_all_categories($limit = 10)
    {
        return \Botble\Blog\Models\Category::query()
            ->wherePublished()
            ->orderBy('order')
            ->limit($limit)
            ->get();
    }
}

if (!function_exists('get_popular_posts')) {
    function get_popular_posts($limit = 5)
    {
        return \Botble\Blog\Models\Post::query()
            ->wherePublished()
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }
}

if (!function_exists('get_recent_posts')) {
    function get_recent_posts($limit = 5)
    {
        return \Botble\Blog\Models\Post::query()
            ->wherePublished()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
} 