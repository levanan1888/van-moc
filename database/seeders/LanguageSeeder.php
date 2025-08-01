<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\Language;
use Botble\Language\Models\LanguageMeta;
use Botble\Setting\Models\Setting;

class LanguageSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'lang_name' => 'English',
                'lang_locale' => 'en',
                'lang_is_default' => true,
                'lang_code' => 'en_US',
                'lang_is_rtl' => false,
                'lang_flag' => 'us',
                'lang_order' => 0,
            ],
            [
                'lang_name' => 'Tiếng Việt',
                'lang_locale' => 'vi',
                'lang_is_default' => false,
                'lang_code' => 'vi',
                'lang_is_rtl' => false,
                'lang_flag' => 'vn',
                'lang_order' => 0,
            ],
        ];

        Language::truncate();
        LanguageMeta::truncate();

        foreach ($languages as $item) {
            Language::create($item);
        }

        Setting::whereIn('key', [
            'language_hide_default',
            'language_switcher_display',
            'language_display',
            'language_hide_languages',
        ])
            ->delete();

        Setting::insertOrIgnore([
            [
                'key' => 'language_hide_default',
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'language_switcher_display',
                'value' => 'list',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'language_display',
                'value' => 'all',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'language_hide_languages',
                'value' => '[]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
