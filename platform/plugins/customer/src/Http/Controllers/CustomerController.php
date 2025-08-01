<?php

namespace Botble\Customer\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Traits\HasDeleteManyItemsTrait;
use Botble\Customer\Forms\CustomerForm;
use Botble\Customer\Http\Requests\CustomerRequest;
use Botble\Customer\Models\Customer;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Customer\Tables\CustomerTable;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Throwable;

class CustomerController extends BaseController
{
    use HasDeleteManyItemsTrait;

    /**
     * @var CustomerInterface
     */
    protected $customerRepository;

    /**
     * @param CustomerInterface $customerRepository
     */
    public function __construct(
        CustomerInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param CustomerTable $dataTable
     * @return Factory|View
     * @throws Throwable
     */
    public function index(CustomerTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/customer::customers.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/customer::customers.create'));

        return $formBuilder->create(CustomerForm::class)->renderForm();
    }

    /**
     * @param CustomerRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(
        CustomerRequest $request,
        BaseHttpResponse $response
    ) {
        /**
         * @var Customer $customer
         */
        $customer = $this->customerRepository->createOrUpdate(array_merge($request->input(), [
            'author_id' => Auth::id(),
            'author_type' => User::class,
        ]));

        event(new CreatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

        return $response
            ->setPreviousUrl(route('customers.index'))
            ->setNextUrl(route('customers.edit', $customer->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $customer = $this->customerRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $customer));

        page_title()->setTitle(trans('plugins/customer::customers.edit') . ' "' . $customer->name . '"');

        return $formBuilder->create(CustomerForm::class, ['model' => $customer])->renderForm();
    }

    /**
     * @param int $id
     * @param CustomerRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update(
        $id,
        CustomerRequest $request,
        BaseHttpResponse $response
    ) {
        $customer = $this->customerRepository->findOrFail($id);

        $customer->fill($request->input());

        $this->customerRepository->createOrUpdate($customer);

        event(new UpdatedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

        return $response
            ->setPreviousUrl(route('customers.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function destroy($id, Request $request, BaseHttpResponse $response)
    {
        try {
            $customer = $this->customerRepository->findOrFail($id);
            $this->customerRepository->delete($customer);

            event(new DeletedContentEvent(CUSTOMER_MODULE_SCREEN_NAME, $request, $customer));

            return $response
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->customerRepository, CUSTOMER_MODULE_SCREEN_NAME);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Throwable
     */
    public function getWidgetRecentCustomers(Request $request, BaseHttpResponse $response)
    {
        $limit = (int)$request->input('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $customers = $this->customerRepository->advancedGet([
            'with' => ['slugable'],
            'order_by' => ['created_at' => 'desc'],
            'paginate' => [
                'per_page' => $limit,
                'current_paged' => (int)$request->input('page', 1),
            ],
        ]);

        return $response
            ->setData(view('plugins/customer::customers.widgets.customers', compact('customers', 'limit'))->render());
    }
}
