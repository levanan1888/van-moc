<?php

// Đăng ký theme options
add_action(BASE_ACTION_INIT, function () {
    if (setting('theme_van-moc_site_title')) {
        theme_option()->setOption('site_title', setting('theme_van-moc_site_title'));
    }
    
    if (setting('theme_van-moc_site_description')) {
        theme_option()->setOption('site_description', setting('theme_van-moc_site_description'));
    }
    
    if (setting('theme_van-moc_logo')) {
        theme_option()->setOption('logo', setting('theme_van-moc_logo'));
    }
    
    if (setting('theme_van-moc_favicon')) {
        theme_option()->setOption('favicon', setting('theme_van-moc_favicon'));
    }
    
    if (setting('theme_van-moc_contact_email')) {
        theme_option()->setOption('contact_email', setting('theme_van-moc_contact_email'));
    }
    
    if (setting('theme_van-moc_contact_phone')) {
        theme_option()->setOption('contact_phone', setting('theme_van-moc_contact_phone'));
    }
    
    if (setting('theme_van-moc_contact_address')) {
        theme_option()->setOption('contact_address', setting('theme_van-moc_contact_address'));
    }
    
    if (setting('theme_van-moc_social_facebook')) {
        theme_option()->setOption('social_facebook', setting('theme_van-moc_social_facebook'));
    }
    
    if (setting('theme_van-moc_social_twitter')) {
        theme_option()->setOption('social_twitter', setting('theme_van-moc_social_twitter'));
    }
    
    if (setting('theme_van-moc_social_linkedin')) {
        theme_option()->setOption('social_linkedin', setting('theme_van-moc_social_linkedin'));
    }
    
    if (setting('theme_van-moc_social_pinterest')) {
        theme_option()->setOption('social_pinterest', setting('theme_van-moc_social_pinterest'));
    }
}, 2);

// Đăng ký theme options
add_action(BASE_ACTION_INIT, function () {
    if (setting('theme_van-moc_site_title')) {
        Theme::set('site_title', setting('theme_van-moc_site_title'));
    }
    
    if (setting('theme_van-moc_site_description')) {
        Theme::set('site_description', setting('theme_van-moc_site_description'));
    }
    
    if (setting('theme_van-moc_logo')) {
        Theme::set('logo', setting('theme_van-moc_logo'));
    }
    
    if (setting('theme_van-moc_favicon')) {
        Theme::set('favicon', setting('theme_van-moc_favicon'));
    }
    
    if (setting('theme_van-moc_contact_email')) {
        Theme::set('contact_email', setting('theme_van-moc_contact_email'));
    }
    
    if (setting('theme_van-moc_contact_phone')) {
        Theme::set('contact_phone', setting('theme_van-moc_contact_phone'));
    }
    
    if (setting('theme_van-moc_contact_address')) {
        Theme::set('contact_address', setting('theme_van-moc_contact_address'));
    }
    
    if (setting('theme_van-moc_social_facebook')) {
        Theme::set('social_facebook', setting('theme_van-moc_social_facebook'));
    }
    
    if (setting('theme_van-moc_social_twitter')) {
        Theme::set('social_twitter', setting('theme_van-moc_social_twitter'));
    }
    
    if (setting('theme_van-moc_social_linkedin')) {
        Theme::set('social_linkedin', setting('theme_van-moc_social_linkedin'));
    }
    
    if (setting('theme_van-moc_social_pinterest')) {
        Theme::set('social_pinterest', setting('theme_van-moc_social_pinterest'));
    }
}, 2);

// Đăng ký theme options form
add_action(BASE_ACTION_AFTER_CREATE_CONTENT, function ($screen, $request, $object) {
    if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME') && $screen == THEME_OPTIONS_MODULE_SCREEN_NAME) {
        ThemeOption::setSection([
            'title' => 'Vạn Mộc Theme Options',
            'desc' => 'Cấu hình theme Vạn Mộc',
            'id' => 'opt-text-subsection',
            'subsection' => true,
            'icon' => 'fa fa-info-circle',
            'fields' => [
                [
                    'id' => 'site_title',
                    'type' => 'text',
                    'label' => 'Site Title',
                    'attributes' => [
                        'name' => 'theme_van-moc_site_title',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Vạn Mộc Mall',
                        ]
                    ],
                ],
                [
                    'id' => 'site_description',
                    'type' => 'textarea',
                    'label' => 'Site Description',
                    'attributes' => [
                        'name' => 'theme_van-moc_site_description',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Mô tả website',
                        ]
                    ],
                ],
                [
                    'id' => 'logo',
                    'type' => 'mediaImage',
                    'label' => 'Logo',
                    'attributes' => [
                        'name' => 'theme_van-moc_logo',
                        'value' => null,
                    ],
                ],
                [
                    'id' => 'favicon',
                    'type' => 'mediaImage',
                    'label' => 'Favicon',
                    'attributes' => [
                        'name' => 'theme_van-moc_favicon',
                        'value' => null,
                    ],
                ],
                [
                    'id' => 'contact_email',
                    'type' => 'text',
                    'label' => 'Contact Email',
                    'attributes' => [
                        'name' => 'theme_van-moc_contact_email',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'vanmocmall@gmail.com',
                        ]
                    ],
                ],
                [
                    'id' => 'contact_phone',
                    'type' => 'text',
                    'label' => 'Contact Phone',
                    'attributes' => [
                        'name' => 'theme_van-moc_contact_phone',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => '081 611 1123',
                        ]
                    ],
                ],
                [
                    'id' => 'contact_address',
                    'type' => 'textarea',
                    'label' => 'Contact Address',
                    'attributes' => [
                        'name' => 'theme_van-moc_contact_address',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => '860/60N/8 Xô Viết Nghệ Tĩnh, phường Bình Thạnh, Tp.Hồ Chí Minh',
                        ]
                    ],
                ],
                [
                    'id' => 'social_facebook',
                    'type' => 'text',
                    'label' => 'Facebook URL',
                    'attributes' => [
                        'name' => 'theme_van-moc_social_facebook',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'https://facebook.com/vanmocmall',
                        ]
                    ],
                ],
                [
                    'id' => 'social_twitter',
                    'type' => 'text',
                    'label' => 'Twitter URL',
                    'attributes' => [
                        'name' => 'theme_van-moc_social_twitter',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'https://twitter.com/vanmocmall',
                        ]
                    ],
                ],
                [
                    'id' => 'social_linkedin',
                    'type' => 'text',
                    'label' => 'LinkedIn URL',
                    'attributes' => [
                        'name' => 'theme_van-moc_social_linkedin',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'https://linkedin.com/company/vanmocmall',
                        ]
                    ],
                ],
                [
                    'id' => 'social_pinterest',
                    'type' => 'text',
                    'label' => 'Pinterest URL',
                    'attributes' => [
                        'name' => 'theme_van-moc_social_pinterest',
                        'value' => null,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'https://pinterest.com/vanmocmall',
                        ]
                    ],
                ],
            ]
        ]);
    }
}, 3, 3);
