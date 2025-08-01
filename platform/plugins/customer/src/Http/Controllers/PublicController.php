<?php

namespace Botble\Customer\Http\Controllers;

use Botble\Customer\Models\Category;
use Botble\Customer\Models\Customer;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Customer\Services\CustomerService;
use Botble\Theme\Events\RenderingSingleEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Response;
use SeoHelper;
use SlugHelper;
use Theme;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @param CustomerInterface $CustomerRepository
     * @return Response
     */
    public function getSearch(Request $request, CustomerInterface $CustomerRepository)
    {
        $query = $request->input('q');

        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $Customers = $CustomerRepository->getSearch($query, 0, 12);

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.customer.search'));

        return Theme::scope('search', compact('customers'))
            ->render();
    }

    /**
     * @param string $slug
     * @param CustomerService $CustomerService
     * @return RedirectResponse|Response
     */
    public function getCustomer($slug, CustomerService $CustomerService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Customer::class));

        if (!$slug) {
            abort(404);
        }

        $data = $CustomerService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Customer::class) . '/' . $data['slug']));
        }

        event(new RenderingSingleEvent($slug));

        Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }
}
