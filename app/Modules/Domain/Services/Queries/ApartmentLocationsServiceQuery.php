<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\ApartmentLocationsRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ApartmentLocationsServiceQuery extends ServiceQuery
{
    private $repository;

    function __construct() {
        $this->repository = new ApartmentLocationsRepositoryQuery();
    }

    public function getList($input) {
        return $this->repository->getList($input);
    }

    public function getById($id) {
        return $this->repository->getById($id);
    }

    public function getAll() {
        return $this->repository->getAll();
    }

    public function getListFrontend($limit = 12) {
        return $this->repository->getListFrontend($limit);
    }

    public function getByAlias($alias) {
        return $this->repository->getByAlias($alias);
    }
}
