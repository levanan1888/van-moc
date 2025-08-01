<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Customer\Supports\CustomerFormat;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('get_all_customers')) {
    /**
     * @param boolean $active
     * @param int $perPage
     * @param array $with
     * @return Collection
     */
    function get_all_customers(
        bool $active = true,
        int $perPage = 12,
        array $with = ['slugable', 'author']
    ) {
        return app(CustomerInterface::class)->getAllCustomers($perPage, $active, $with);
    }
}

if (!function_exists('get_featured_customers')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_featured_customers(int $limit, array $with = [], array $except = []) {
        return app(CustomerInterface::class)->getFeaturedCustomers($limit, $with, $except);
    }
}

if (!function_exists('get_related_customers')) {
    /**
     * @param int $id
     * @param int $limit
     * @return Collection
     */
    function get_related_customers(int $id, int $limit): Collection
    {
        return app(CustomerInterface::class)->getRelated($id, $limit);
    }
}

if (!function_exists('register_customer_format')) {
    /**
     * @param array $formats
     * @return void
     */
    function register_customer_format(array $formats)
    {
        CustomerFormat::registerCustomerFormat($formats);
    }
}

if (!function_exists('get_customer_formats')) {
    /**
     * @param bool $convertToList
     * @return array
     */
    function get_customer_formats(bool $convertToList = false): array
    {
        return CustomerFormat::getCustomerFormats($convertToList);
    }
}

if (!function_exists('get_customer_page_id')) {
    /**
     * @return int
     */
    function get_customer_page_id(): int
    {
        return (int)theme_option('customer_page_id', setting('customer_page_id'));
    }
}

if (!function_exists('get_customer_page_url')) {
    /**
     * @return string
     */
    function get_customer_page_url(): string
    {
        $blogPageId = (int)theme_option('customer_page_id', setting('customer_page_id'));

        if (!$blogPageId) {
            return url('/');
        }

        $blogPage = app(\Botble\Page\Repositories\Interfaces\PageInterface::class)->findById($blogPageId);

        if (!$blogPage) {
            return url('/');
        }

        return $blogPage->url;
    }
}
