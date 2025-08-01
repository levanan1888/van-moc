<?php

namespace Botble\Product\Services\Abstracts;

use Botble\Product\Models\Product;
use Botble\Product\Repositories\Interfaces\TagInterface;
use Illuminate\Http\Request;

abstract class StoreTagServiceAbstract
{
    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * StoreTagService constructor.
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return mixed
     */
    abstract public function execute(Request $request, Product $product);
}
