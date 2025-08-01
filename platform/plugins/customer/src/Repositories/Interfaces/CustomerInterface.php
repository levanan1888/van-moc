<?php

namespace Botble\Customer\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Eloquent;

interface CustomerInterface extends RepositoryInterface
{
    /**
     * @param array $selected
     * @param int $limit
     * @param array $with
     * @return mixed
     */
    public function getListCustomerNonInList(array $selected = [], $limit = 7, array $with = []);

    /**
     * @param int $authorId
     * @param int $limit
     * @return mixed
     */
    public function getByUserId($authorId, $limit = 6);

    /**
     * @return mixed
     */
    public function getDataSiteMap();

    /**
     * @param int $perPage
     * @param bool $active
     * @return mixed
     */
    public function getAllCustomers($perPage = 12, $active = true, array $with = ['slugable']);

    /**
     * @param int $limit
     * @param array $with
     */
    public function getFeaturedCustomers($limit, array $with = [], array $except = []);

    /**
     * @param int $id
     * @param int $limit
     * @return mixed
     */
    public function getRelated($id, $limit = 3);
}
