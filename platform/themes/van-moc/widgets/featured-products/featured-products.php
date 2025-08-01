<?php

use Botble\Widget\AbstractWidget;

class FeaturedProductsWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $widgetDirectory = 'featured-products';

    /**
     * FeaturedProductsWidget constructor.
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function __construct()
    {
        parent::__construct([
            'name' => __('Featured Products'),
            'description' => __('Display featured products.'),
            'number_display' => 4,
        ]);
    }

    /**
     * Get data for widget
     */
    public function getData()
    {
        $limit = $this->getConfig('number_display', 4);
        
        // Lấy sản phẩm từ database
        if (class_exists('Botble\Ecommerce\Models\Product')) {
            return \Botble\Ecommerce\Models\Product::where('is_featured', 1)
                ->where('status', 'published')
                ->with(['slugable', 'categories', 'tags'])
                ->orderBy('order', 'asc')
                ->limit($limit)
                ->get();
        }
        
        return collect();
    }
} 