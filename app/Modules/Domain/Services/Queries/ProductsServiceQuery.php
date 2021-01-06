<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\ProductsRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ProductsServiceQuery extends ServiceQuery
{
    function __construct() {
        $this->_repository = new ProductsRepositoryQuery();
    }

    public function getList($input) {
        $list = $this->_repository->getList($input);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }
        unset($item);
        return $list;
    }

    public function getListByIn($ids) {
        $list = $this->_repository->getListByIn($ids);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }
        unset($item);
        return $list;
    }

    public function getById($id) {
        if (empty($content = $this->_repository->getById($id))) {
            return null;
        }

        if ($content->publish_up == $content->publish_down) {
            $content->publish_down = '';
        }

        return $content;
    }

    public function getByAlias($alias) {
        return $this->_repository->getByAlias($alias);
    }

    public function getTotal() {
        return $this->_repository->getTotal();
    }

    public function getListByCategoryId($id) {
        $result = [];
        $list = $this->_repository->getListByCategoryId($id, 5);
        foreach ($list as $item) {
            $item['images'] = explode(',', $item['images']);
            $result[] = $item;
        }

        return $result;
    }

    public function getListForFrontend($id) {
        $list = $this->_repository->getListForFrontend($id);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }

        return $list;
    }

    public function getListByWidget($input) {
        return $this->_repository->getListByWidget($input);
    }
}
