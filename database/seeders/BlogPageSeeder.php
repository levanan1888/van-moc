<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Botble\Page\Models\Page;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;

class BlogPageSeeder extends Seeder
{
    public function run()
    {
        // Create blog page
        $page = Page::create([
            'name' => 'Blog làm đẹp tự nhiên',
            'content' => '{!! do_shortcode("[blog-section]") !!}',
            'template' => 'default',
            'user_id' => 1,
            'is_introduce_sidebar' => false,
        ]);

        // Create slug for the page
        Slug::create([
            'reference_type' => Page::class,
            'reference_id' => $page->id,
            'key' => Str::slug('blog-lam-dep-tu-nhien'),
            'prefix' => '',
        ]);
    }
}
