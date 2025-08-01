<?php

namespace Botble\Customer\Listeners;

use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use SiteMapManager;

class RenderingSiteMapListener
{
    /**
     * @var CustomerInterface
     */
    protected $customerRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param CustomerInterface $customerRepository
     */
    public function __construct(CustomerInterface $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $customers = $this->customerRepository->getDataSiteMap();
        foreach ($customers as $customer) {
            SiteMapManager::add($customer->url, $customer->updated_at, '0.5');
        }
    }
}
