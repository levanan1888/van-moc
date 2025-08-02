<?php

// Register shortcodes
add_shortcode('hero-section', 'Hero Section', 'Hero Section', function ($shortcode) {
    return Theme::partial('shortcodes.hero-section', compact('shortcode'));
});

add_shortcode('featured-products', 'Featured Products', 'Featured Products', function ($shortcode) {
    return Theme::partial('shortcodes.featured-products', compact('shortcode'));
});

add_shortcode('product-categories', 'Product Categories', 'Product Categories', function ($shortcode) {
    return Theme::partial('shortcodes.product-categories', compact('shortcode'));
});

add_shortcode('van-moc-story', 'Van Moc Story', 'Van Moc Story', function ($shortcode) {
    return Theme::partial('shortcodes.van-moc-story', compact('shortcode'));
});

add_shortcode('philosophy-vision-mission', 'Philosophy Vision Mission', 'Philosophy Vision Mission', function ($shortcode) {
    return Theme::partial('shortcodes.philosophy-vision-mission', compact('shortcode'));
});

add_shortcode('sustainability', 'Sustainability', 'Sustainability', function ($shortcode) {
    return Theme::partial('shortcodes.sustainability', compact('shortcode'));
});

add_shortcode('blog-section', 'Blog Section', 'Blog Section', function ($shortcode) {
    return Theme::partial('shortcodes.blog-section', compact('shortcode'));
});

add_shortcode('agent-signup', 'Agent Signup', 'Agent Signup', function ($shortcode) {
    return Theme::partial('shortcodes.agent-signup', compact('shortcode'));
});

add_shortcode('contact-form', 'Contact Form', 'Contact Form', function ($shortcode) {
    return Theme::partial('shortcodes.contact-form', compact('shortcode'));
});

add_shortcode('product-list', 'Product List', 'Product List', function ($shortcode) {
    return Theme::partial('shortcodes.product-list', compact('shortcode'));
});
