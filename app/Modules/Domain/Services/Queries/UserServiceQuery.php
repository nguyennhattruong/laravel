<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\UserRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class UserServiceQuery extends ServiceQuery
{
    private $_query;

    function __construct() {
        $this->_query = new UserRepositoryQuery();
    }

    public function getList($input) {
        return $this->_query->getList($input);
    }

    public function getById($id) {
        return $this->_query->getById($id);
    }

    public function hasByName($name) {
        return $this->_query->hasByName($name);
    }
}
