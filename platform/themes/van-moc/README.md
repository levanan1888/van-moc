# Vạn Mộc Theme - Botble CMS

Theme Vạn Mộc được thiết kế để tương thích hoàn toàn với Botble CMS, cho phép quản lý nội dung động từ backend.

## 🎯 Tính năng chính

### ✅ Tích hợp CMS hoàn chỉnh
- **Quản lý sản phẩm**: Thêm/sửa/xóa sản phẩm từ admin panel
- **Quản lý danh mục**: Tạo và quản lý danh mục sản phẩm
- **Quản lý bài viết**: Hệ thống blog tích hợp
- **Quản lý thông tin liên hệ**: Email, phone, địa chỉ
- **Quản lý social media**: Facebook, Twitter, LinkedIn, Pinterest
- **Quản lý logo**: Upload và thay đổi logo dễ dàng

### ✅ Default Images
- Sử dụng `RvMedia::getDefaultImage()` cho tất cả hình ảnh
- Fallback data khi không có plugin ecommerce/blog
- Hình ảnh placeholder tự động

### ✅ Shortcodes linh hoạt
- `[hero-section]` - Hero section với nội dung tùy chỉnh
- `[featured-products]` - Sản phẩm nổi bật (từ CMS hoặc fallback)
- `[product-categories]` - Danh mục sản phẩm (từ CMS hoặc fallback)
- `[van-moc-story]` - Câu chuyện Vạn Mộc
- `[philosophy-vision-mission]` - Triết lý, tầm nhìn, sứ mệnh
- `[sustainability]` - Phát triển bền vững
- `[blog-section]` - Bài viết blog (từ CMS hoặc fallback)
- `[agent-signup]` - Đăng ký đại lý

### ✅ Widgets
- `FeaturedProductsWidget` - Widget sản phẩm nổi bật
- Tích hợp với Botble Widget system

## 🚀 Cài đặt và sử dụng

### 1. Copy hình ảnh
Xem file `public/images/COPY_IMAGES_GUIDE.md` để copy hình ảnh từ thư mục `test/`

### 2. Publish assets
```bash
php artisan cms:theme:assets:publish
```

### 3. Kích hoạt theme
Vào Admin Panel → Appearance → Themes → Kích hoạt "Vạn Mộc"

### 4. Cấu hình theme options
Vào Admin Panel → Settings → Theme Options → Vạn Mộc Theme Options

## 📋 Quản lý nội dung

### Menu
- Vào **Menu** → **Menu Locations** để tạo menu
- **Main Menu**: Menu chính trong header
- **Footer Menu 1**: Menu "VỀ CHÚNG TÔI" trong footer
- **Footer Menu 2**: Menu "BẠN NÊN BIẾT" trong footer
- Menu sẽ tự động hiển thị trong header và footer

### Sản phẩm
- Vào **Products** → **Products** để thêm/sửa/xóa sản phẩm
- Sản phẩm sẽ tự động hiển thị trong shortcode `[featured-products]`
- Widget "Featured Products" cũng sẽ hiển thị sản phẩm từ database

### Danh mục
- Vào **Products** → **Product Categories** để quản lý danh mục
- Danh mục sẽ hiển thị trong shortcode `[product-categories]`

### Bài viết
- Vào **Blog** → **Posts** để quản lý bài viết
- Bài viết sẽ hiển thị trong shortcode `[blog-section]`

### Widgets
- Vào **Appearance** → **Widgets** để thêm widgets vào sidebar
- Widget "Featured Products" sẽ hiển thị sản phẩm nổi bật từ database

### Thông tin liên hệ
- Vào **Settings** → **Theme Options** → **Vạn Mộc Theme Options**
- Cấu hình email, phone, địa chỉ, social media

## 🎨 Tùy chỉnh giao diện

### CSS
- File chính: `public/css/style.css`
- Responsive design cho mobile, tablet, desktop

### JavaScript
- File chính: `public/js/script.js`
- Mobile menu, smooth scrolling, form handling

### Layouts
- `layouts/default.blade.php` - Layout chính
- `layouts/no-sidebar.blade.php` - Layout không sidebar

### Partials
- `partials/header.blade.php` - Header
- `partials/footer.blade.php` - Footer
- `partials/breadcrumbs.blade.php` - Breadcrumbs

## 🔧 Cấu trúc thư mục

```
platform/themes/van-moc/
├── functions/
│   ├── shortcodes.php          # Đăng ký shortcodes
│   ├── widgets.php             # Đăng ký widgets
│   └── theme-options.php       # Theme options
├── layouts/
│   ├── default.blade.php       # Layout chính
│   └── no-sidebar.blade.php    # Layout không sidebar
├── partials/
│   ├── header.blade.php        # Header
│   ├── footer.blade.php        # Footer
│   ├── breadcrumbs.blade.php   # Breadcrumbs
│   └── shortcodes/             # Shortcode templates
│       ├── hero-section.blade.php
│       ├── featured-products.blade.php
│       ├── product-categories.blade.php
│       ├── van-moc-story.blade.php
│       ├── philosophy-vision-mission.blade.php
│       ├── sustainability.blade.php
│       ├── blog-section.blade.php
│       └── agent-signup.blade.php
├── public/
│   ├── css/
│   │   └── style.css           # CSS chính
│   ├── js/
│   │   └── script.js           # JavaScript chính
│   └── images/                 # Hình ảnh theme
├── views/
│   └── index.blade.php         # Trang chủ
└── widgets/                    # Widgets
    └── featured-products/
        ├── featured-products.php
        └── templates/
            ├── frontend.blade.php
            └── backend.blade.php
```

## 🌟 Lợi ích

### Cho người dùng cuối
- Giao diện đẹp, responsive
- Tải trang nhanh
- Dễ sử dụng trên mobile

### Cho admin
- Quản lý nội dung dễ dàng
- Không cần code để thay đổi nội dung
- Tích hợp hoàn toàn với Botble CMS

### Cho developer
- Code sạch, dễ maintain
- Tương thích với Botble standards
- Dễ mở rộng và tùy chỉnh

## 🔄 Tương thích

### Plugins hỗ trợ
- ✅ Blog plugin
- ✅ Ecommerce plugin (nếu có)
- ✅ Media plugin
- ✅ Widget plugin
- ✅ Shortcode plugin

### Fallback data
- Khi không có plugin ecommerce: Hiển thị sản phẩm mẫu
- Khi không có plugin blog: Hiển thị bài viết mẫu
- Khi không có hình ảnh: Sử dụng default image

## 📞 Hỗ trợ

Nếu gặp vấn đề:
1. Kiểm tra file `COPY_IMAGES_GUIDE.md`
2. Chạy `php artisan cms:theme:assets:publish`
3. Clear cache: `php artisan cache:clear`
4. Kiểm tra logs trong `storage/logs/`

## 🎯 Roadmap

- [ ] Tích hợp payment gateway
- [ ] Multi-language support
- [ ] Advanced product filters
- [ ] Wishlist functionality
- [ ] Product reviews
- [ ] Newsletter subscription
- [ ] Advanced SEO options 