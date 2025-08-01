<?php

// Đăng ký shortcode cho Static Blocks
add_shortcode('static-block', 'Static Block', 'Static Block', function ($shortcode) {
    $alias = $shortcode->alias;
    
    if (!$alias) {
        return '';
    }
    
    // Lấy static block từ database
    if (class_exists('Botble\Block\Models\Block')) {
        $block = \Botble\Block\Models\Block::where('alias', $alias)
            ->where('status', 'published')
            ->first();
            
        if ($block) {
            return $block->content;
        }
    }
    
    return '';
}); 