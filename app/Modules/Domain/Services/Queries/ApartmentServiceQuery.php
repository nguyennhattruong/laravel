<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\ApartmentRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ApartmentServiceQuery extends ServiceQuery
{
    function __construct() {
        $this->_repository = new ApartmentRepositoryQuery();
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
        $result = $this->_repository->getByAlias($alias);
        $result['images'] = explode(',', $result['images']);
        return $result;
    }

    public function getTotal() {
        return $this->_repository->getTotal();
    }

    public function getListByTypeId($id) {
        $list = $this->_repository->getListByTypeId($id);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }

        return $list;
    }

    public function getListForFrontend($id) {
        $list = $this->_repository->getListForFrontend($id);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }

        return $list;
    }

    public function getListByLocation($locationId) {
        return $this->_repository->getListByLocation($locationId);
    }

    public function getListByWidget($input) {
        $list = $this->_repository->getListByWidget($input);
        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }

        return $list;
    }

    public function search($input) {
        $list = $this->_repository->search($input);

        foreach ($list as &$item) {
            $item['images'] = explode(',', $item['images']);
        }

        return $list;
    }
}
