<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\MenuTypes;
use App\Modules\Domain\Repositories\Queries\MenuTypesRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class MenuTypesServiceQuery extends ServiceQuery
{
    private $_repositories;

    function __construct() {
        $this->_repositories = new MenuTypesRepositoryQuery();
    }

    public function getList($input) {
        return $this->_repositories->getList($input);
    }

    public function getAll() {
        return $this->_repositories->getAll();
    }

    public function getAllForControl() {
        return $this->_repositories->getAllForControl();
    }

    public function getById($id) {
        return MenuTypes::find($id);
    }
}
