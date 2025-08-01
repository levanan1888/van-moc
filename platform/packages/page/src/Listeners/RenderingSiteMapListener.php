<?php

namespace Botble\Page\Listeners;

use Botble\Page\Repositories\Interfaces\PageInterface;
use SiteMapManager;
use BaseHelper;

class RenderingSiteMapListener
{
    /**
     * @var PageInterface
     */
    protected $pageRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param PageInterface $pageRepository
     */
    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $pages = $this->pageRepository->getDataSiteMap();

        foreach ($pages as $page) {
            $priority = !BaseHelper::isHomepage($page->id) ? '0.4' : '1.0';
            SiteMapManager::add(BaseHelper::isHomepage($page->id) ? $page->url . '/' : $page->url, $page->updated_at, $priority);
        }
    }
}
