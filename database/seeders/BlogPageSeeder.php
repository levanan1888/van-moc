<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Botble\Page\Models\Page;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;

class BlogPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create blog page
        $blogPage = Page::create([
            'name' => 'Blog làm đẹp tự nhiên',
            'description' => 'Trang blog chia sẻ kiến thức về làm đẹp tự nhiên, chăm sóc da, tóc và sức khỏe',
            'content' => '<shortcode class="bb-shortcode">[blog-posts paginate="12"][/blog-posts]</shortcode>',
            'template' => 'blog',
            'status' => 'published',
            'user_id' => 1,
            'is_introduce_sidebar' => true,
        ]);

        // Create slug for blog page
        Slug::create([
            'reference_type' => Page::class,
            'reference_id' => $blogPage->id,
            'key' => 'blog',
            'prefix' => '',
        ]);

        $this->command->info('Blog page created successfully!');
    }
}
