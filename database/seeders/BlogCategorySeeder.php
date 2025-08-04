<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create blog categories
        $categories = [
            'Mỹ phẩm' => 'my-pham',
            'Chăm sóc tóc' => 'cham-soc-toc',
            'Chăm sóc da' => 'cham-soc-da',
            'Trang điểm' => 'trang-diem',
            'Mặt trời và du lịch' => 'mat-troi-va-du-lich',
            'Nước yến' => 'nuoc-yen',
            'Phong cách sống' => 'phong-cach-song',
            'Dinh dưỡng' => 'dinh-duong',
            'Sinh thái & Đạo đức' => 'sinh-thai-dao-duc',
            'Ăn uống' => 'an-uong',
        ];

        foreach ($categories as $name => $slug) {
            $category = Category::create([
                'name' => $name,
                'description' => 'Danh mục ' . $name,
                'is_default' => false,
                'order' => 0,
                'is_featured' => false,
                'status' => 'published',
                'author_id' => 1,
            ]);

            // Create slug
            Slug::create([
                'reference_type' => Category::class,
                'reference_id' => $category->id,
                'key' => $slug,
                'prefix' => 'blog/category',
            ]);
        }

        // Create sample blog posts
        $posts = [
            [
                'name' => 'Vì sao nên dùng mỹ phẩm thiên nhiên?',
                'description' => 'Những lý do thuyết phục để bạn chuyển sang sử dụng mỹ phẩm thiên nhiên thay vì các sản phẩm hóa học.',
                'content' => 'Nội dung chi tiết về lợi ích của mỹ phẩm thiên nhiên...',
                'category_id' => Category::where('name', 'Mỹ phẩm')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame603.png',
            ],
            [
                'name' => 'Cách uống yến đúng để đẹp da khỏe người',
                'description' => 'Hướng dẫn chi tiết cách sử dụng yến sào hiệu quả để có làn da đẹp và sức khỏe tốt.',
                'content' => 'Nội dung chi tiết về cách sử dụng yến sào...',
                'category_id' => Category::where('name', 'Nước yến')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame604.png',
            ],
            [
                'name' => 'Tóc bạn đang hư tổn vì lý do này!',
                'description' => 'Khám phá những nguyên nhân gây hư tổn tóc và cách khắc phục hiệu quả.',
                'content' => 'Nội dung chi tiết về nguyên nhân hư tổn tóc...',
                'category_id' => Category::where('name', 'Chăm sóc tóc')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame603.png',
            ],
            [
                'name' => '5 mẹo chăm da mỗi ngày cực đơn giản',
                'description' => 'Những bước chăm sóc da đơn giản, dễ áp dụng giúp duy trì làn da khỏe mạnh mỗi ngày.',
                'content' => 'Nội dung chi tiết về các mẹo chăm sóc da...',
                'category_id' => Category::where('name', 'Chăm sóc da')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame604.png',
            ],
            [
                'name' => 'Lợi ích của yến sào với sắc đẹp phụ nữ',
                'description' => 'Tìm hiểu về những lợi ích tuyệt vời của yến sào đối với sắc đẹp và sức khỏe phụ nữ.',
                'content' => 'Nội dung chi tiết về lợi ích của yến sào...',
                'category_id' => Category::where('name', 'Nước yến')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame603.png',
            ],
            [
                'name' => 'Chống lão hóa tự nhiên với chế độ ăn sạch',
                'description' => 'Cách chống lão hóa hiệu quả thông qua chế độ ăn uống lành mạnh và tự nhiên.',
                'content' => 'Nội dung chi tiết về chế độ ăn chống lão hóa...',
                'category_id' => Category::where('name', 'Dinh dưỡng')->first()->id,
                'image' => 'test/VMM_image/VMM_image/hinh_baiviet(2)/frame604.png',
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'name' => $postData['name'],
                'description' => $postData['description'],
                'content' => $postData['content'],
                'image' => $postData['image'],
                'is_featured' => false,
                'status' => 'published',
                'views' => rand(1000, 5000),
                'author_id' => 1,
            ]);

            // Create slug
            $slug = Str::slug($postData['name']);
            Slug::create([
                'reference_type' => Post::class,
                'reference_id' => $post->id,
                'key' => $slug,
                'prefix' => 'blog',
            ]);

            // Attach category
            $post->categories()->attach($postData['category_id']);
        }
    }
}
