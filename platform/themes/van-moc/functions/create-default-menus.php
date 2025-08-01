<?php

// Tạo menu mặc định cho van-moc theme
add_action(BASE_ACTION_INIT, function () {
    if (!class_exists('Botble\Menu\Models\Menu')) {
        return;
    }
    
    // Tạo Main Menu nếu chưa có
    $mainMenu = \Botble\Menu\Models\Menu::where('name', 'Van Moc Main Menu')->first();
    if (!$mainMenu) {
        $mainMenu = \Botble\Menu\Models\Menu::create([
            'name' => 'Van Moc Main Menu',
            'slug' => 'van-moc-main-menu',
            'status' => 'published',
        ]);
        
        // Tạo menu items
        $menuItems = [
            ['title' => 'TRANG CHỦ', 'url' => '/', 'order' => 1],
            ['title' => 'SẢN PHẨM', 'url' => '/products', 'order' => 2],
            ['title' => 'KHUYẾN MÃI', 'url' => '/promotions', 'order' => 3],
            ['title' => 'BÀI VIẾT', 'url' => '/blog', 'order' => 4],
            ['title' => 'VỀ CHÚNG TÔI', 'url' => '/about', 'order' => 5],
        ];
        
        foreach ($menuItems as $item) {
            \Botble\Menu\Models\MenuNode::create([
                'menu_id' => $mainMenu->id,
                'parent_id' => 0,
                'reference_id' => 0,
                'reference_type' => '',
                'url' => $item['url'],
                'title' => $item['title'],
                'icon_font' => '',
                'css_class' => '',
                'target' => '_self',
                'order' => $item['order'],
            ]);
        }
    }
    
    // Tạo Footer Menu 1
    $footerMenu1 = \Botble\Menu\Models\Menu::where('name', 'Van Moc Footer Menu 1')->first();
    if (!$footerMenu1) {
        $footerMenu1 = \Botble\Menu\Models\Menu::create([
            'name' => 'Van Moc Footer Menu 1',
            'slug' => 'van-moc-footer-menu-1',
            'status' => 'published',
        ]);
        
        $footerItems1 = [
            ['title' => 'Giới thiệu', 'url' => '/about', 'order' => 1],
            ['title' => 'Download Catalogue', 'url' => '/catalogue', 'order' => 2],
        ];
        
        foreach ($footerItems1 as $item) {
            \Botble\Menu\Models\MenuNode::create([
                'menu_id' => $footerMenu1->id,
                'parent_id' => 0,
                'reference_id' => 0,
                'reference_type' => '',
                'url' => $item['url'],
                'title' => $item['title'],
                'icon_font' => '',
                'css_class' => '',
                'target' => '_self',
                'order' => $item['order'],
            ]);
        }
    }
    
    // Tạo Footer Menu 2
    $footerMenu2 = \Botble\Menu\Models\Menu::where('name', 'Van Moc Footer Menu 2')->first();
    if (!$footerMenu2) {
        $footerMenu2 = \Botble\Menu\Models\Menu::create([
            'name' => 'Van Moc Footer Menu 2',
            'slug' => 'van-moc-footer-menu-2',
            'status' => 'published',
        ]);
        
        $footerItems2 = [
            ['title' => 'Hướng dẫn mua hàng', 'url' => '/shopping-guide', 'order' => 1],
            ['title' => 'Chính sách đổi trả', 'url' => '/return-policy', 'order' => 2],
            ['title' => 'Bảo mật thông tin', 'url' => '/privacy', 'order' => 3],
            ['title' => 'Câu hỏi thường gặp', 'url' => '/faq', 'order' => 4],
        ];
        
        foreach ($footerItems2 as $item) {
            \Botble\Menu\Models\MenuNode::create([
                'menu_id' => $footerMenu2->id,
                'parent_id' => 0,
                'reference_id' => 0,
                'reference_type' => '',
                'url' => $item['url'],
                'title' => $item['title'],
                'icon_font' => '',
                'css_class' => '',
                'target' => '_self',
                'order' => $item['order'],
            ]);
        }
    }
    
    // Gán menu locations
    if (class_exists('Botble\Menu\Models\MenuLocation')) {
        // Gán main menu
        \Botble\Menu\Models\MenuLocation::updateOrCreate(
            ['location' => 'main-menu'],
            ['menu_id' => $mainMenu->id]
        );
        
        // Gán footer menu 1
        \Botble\Menu\Models\MenuLocation::updateOrCreate(
            ['location' => 'footer-menu-1'],
            ['menu_id' => $footerMenu1->id]
        );
        
        // Gán footer menu 2
        \Botble\Menu\Models\MenuLocation::updateOrCreate(
            ['location' => 'footer-menu-2'],
            ['menu_id' => $footerMenu2->id]
        );
    }
}, 10); 