<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\Pages;
use App\Modules\Domain\Repositories\Queries\PagesRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class PagesServiceQuery extends ServiceQuery
{
    private $_repQuery;

    function __construct() {
        $this->_repQuery = new PagesRepositoryQuery();
    }

    public function getList($input) {
        return $this->_repQuery->getList($input);
    }

    public function getById($id) {
        $data = Pages::find($id);
        $data->attribs = json_decode($data->attribs);
        return $data;
    }

    public function getByAlias($alias) {
        return $this->_repQuery->getByAlias($alias);
    }
}
