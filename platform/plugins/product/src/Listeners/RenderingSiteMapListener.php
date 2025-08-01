<?php

namespace Botble\Product\Listeners;

use Botble\Product\Repositories\Interfaces\CategoryInterface;
use Botble\Product\Repositories\Interfaces\ProductInterface;
use Botble\Product\Repositories\Interfaces\TagInterface;
use SiteMapManager;

class RenderingSiteMapListener
{
    /**
     * @var ProductInterface
     */
    protected $productRepository;

    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param ProductInterface $productRepository
     * @param CategoryInterface $categoryRepository
     * @param TagInterface $tagRepository
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository,
        TagInterface $tagRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $products = $this->productRepository->getDataSiteMap();

        foreach ($products as $product) {
            SiteMapManager::add($product->url, $product->updated_at, '0.5');
        }

        $categories = $this->categoryRepository->getDataSiteMap();

        foreach ($categories as $category) {
            SiteMapManager::add($category->url, $category->updated_at, '0.8');
        }

        $tags = $this->tagRepository->getDataSiteMap();

        foreach ($tags as $tag) {
            SiteMapManager::add($tag->url, $tag->updated_at, '0.3', 'weekly');
        }
    }
}
