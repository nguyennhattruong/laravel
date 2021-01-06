<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Repositories\Queries\CategoriesRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class CategoriesServiceQuery extends ServiceQuery
{
    function __construct() {
        $this->_repository = new CategoriesRepositoryQuery();
    }

    public function getAll() {
        return $this->_repository->getAll();
    }
    
    public function getList($input) {
        return $this->_repository->getList($input);
    }

    public function getListForControl($current_id = NULL) {
        $result = [];
        $list = $this->_repository->getListForControl($current_id);

        foreach ($list as $item) {
            $result[$item['id']] = str_repeat('- ', $item['depth']) . $item['title'];
        }

        return $result;
    }

    public function getListContentByAlias($alias, $display) {
        return $this->_repository->getListContentByAlias($alias, $display);
    }

    public function getById($id) {
        return Categories::find($id);
    }

    public function getByAlias($alias) {
        return $this->_repository->getByAlias($alias);
    }

    public function getTotal() {
        return $this->_repository->getTotal();
    }

    public function getAncestors($id) {
        return Categories::find($id)->getAncestors();
    }

    public function getSiblingsAndSelf($id) {
        return Categories::find($id)->getSiblingsAndSelf();
    }

    public function getAncestorsAndSelf($id) {
        return Categories::find($id)->getAncestorsAndSelf();
    }

    public function getDescendants($id) {
        return Categories::find($id)->getDescendants();
    }

    public function getDescendantsAndSelf($id) {
        return Categories::find($id)->getDescendantsAndSelf();
    }
}
