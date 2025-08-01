<?php

namespace Botble\Product\Services;

use Botble\ACL\Models\User;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Product\Models\Product;
use Botble\Product\Services\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    /**
     * @param Request $request
     * @param Product $product
     * @return mixed|void
     */
    public function execute(Request $request, Product $product)
    {
        $tags = $product->tags->pluck('name')->all();

        $tagsInput = collect(json_decode($request->input('tag'), true))->pluck('value')->all();

        if (count($tags) != count($tagsInput) || count(array_diff($tags, $tagsInput)) > 0) {
            $product->tags()->detach();
            foreach ($tagsInput as $tagName) {
                if (!trim($tagName)) {
                    continue;
                }

                $tag = $this->tagRepository->getFirstBy(['name' => $tagName]);

                if ($tag === null && !empty($tagName)) {
                    $tag = $this->tagRepository->createOrUpdate([
                        'name' => $tagName,
                        'author_id' => Auth::check() ? Auth::id() : 0,
                        'author_type' => User::class,
                    ]);

                    $request->merge(['slug' => $tagName]);

                    event(new CreatedContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));
                }

                if (!empty($tag)) {
                    $product->tags()->attach($tag->id);
                }
            }
        }
    }
}
