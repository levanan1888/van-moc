<?php

app()->booted(function () {
    theme_option()
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Roboto',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#ff2b4a',
            ],
        ])
        ->setField([
            'id' => 'default_breadcrumb_banner_image',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Default breadcrumb banner image (1920x170px)'),
            'attributes' => [
                'name' => 'default_breadcrumb_banner_image',
                'value' => null,
            ],
        ])
        ->setField([
            'id' => 'site_description',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'editor',
            'label' => __('Site description'),
            'attributes' => [
                'name' => 'site_description',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'url_suffix',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Url Suffix'),
            'attributes' => [
                'name' => 'url_suffix',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'address',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Address'),
            'attributes' => [
                'name' => 'address',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'map_address',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Map Address'),
            'attributes' => [
                'name' => 'map_address',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'website',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'url',
            'label' => __('Website'),
            'attributes' => [
                'name' => 'website',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'contact_email',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'email',
            'label' => __('Email'),
            'attributes' => [
                'name' => 'contact_email',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 120,
                ],
            ],
        ])
        ->setField([
            'id' => 'contact_phone',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Phone'),
            'attributes' => [
                'name' => 'contact_phone',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 120,
                ],
            ],
        ])
        ->setField([
            'id' => 'hotline_phone',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Hotline'),
            'attributes' => [
                'name' => 'hotline_phone',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 120
                ],
            ],
        ])
        ->setField([
            'id' => 'sale_emails',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Sale Emails'),
            'attributes' => [
                'name' => 'sale_emails',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                    'placeholder' => 'abc@gmail.com;def@gmail.com',
                ],
            ],
        ])
        ->setSection([
            'title' => __('Social links'),
            'desc' => __('Social links'),
            'id' => 'opt-text-subsection-social-links',
            'subsection' => true,
            'icon' => 'fa fa-share-alt',
        ])
        ->setField([
            'id' => 'social_links',
            'section_id' => 'opt-text-subsection-social-links',
            'type' => 'repeater',
            'label' => __('Social links'),
            'attributes' => [
                'name' => 'social_links',
                'value' => null,
                'fields' => [
                    [
                        'type' => 'text',
                        'label' => __('Name'),
                        'attributes' => [
                            'name' => 'social-name',
                            'value' => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'label' => __('Key'),
                        'attributes' => [
                            'name' => 'social-key',
                            'value' => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'type' => 'themeIcon',
                        'label' => __('Icon'),
                        'attributes' => [
                            'name' => 'social-icon',
                            'value' => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'label' => __('URL'),
                        'attributes' => [
                            'name' => 'social-url',
                            'value' => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ],
        ])
        ->setField([
            'id' => 'copyright',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Copyright'),
            'attributes' => [
                'name' => 'copyright',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change copyright'),
                    'data-counter' => 255,
                ],
            ],
            'helper' => __('Copyright on footer of site'),
        ])
        ->setField([
            'id' => 'facebook_comment_enabled_in_gallery',
            'section_id' => 'opt-text-subsection-facebook-integration',
            'type' => 'customSelect',
            'label' => __('Enable Facebook comment in the gallery detail?'),
            'attributes' => [
                'name' => 'facebook_comment_enabled_in_gallery',
                'list' => [
                    'no' => trans('core/base::base.no'),
                    'yes' => trans('core/base::base.yes'),
                ],
                'value' => 'no',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ]);
});
