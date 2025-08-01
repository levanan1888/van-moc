<?php

namespace Botble\Customer\Supports;

class CustomerFormat
{
    /**
     * @var array
     */
    protected static $formats = [
        '' => [
            'key' => '',
            'icon' => null,
            'name' => 'Default',
        ],
    ];

    /**
     * @param array $formats
     * @return void
     * @since 16-09-2016
     */
    public static function registerCustomerFormat(array $formats = [])
    {
        foreach ($formats as $key => $format) {
            self::$formats[$key] = $format;
        }
    }

    /**
     * @param bool $isConvertToList
     * @return array
     * @since 16-09-2016
     */
    public static function getCustomerFormats($isConvertToList = false)
    {
        if ($isConvertToList) {
            $results = [];
            foreach (self::$formats as $key => $item) {
                $results[$key] = [
                    $key,
                    $item['name'],
                ];
            }

            return $results;
        }

        return self::$formats;
    }
}
