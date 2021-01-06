<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\ContentRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class ContentServiceQuery extends ServiceQuery
{
    private $_contentRepQuery;

    function __construct() {
        $this->_contentRepQuery = new ContentRepositoryQuery();
    }

    public function getList($input) {
        return $this->_contentRepQuery->getList($input);
    }

    public function getById($id) {
        if (empty($content = $this->_contentRepQuery->getById($id))) {
            return null;
        }

        if ($content->publish_up == $content->publish_down) {
            $content->publish_down = '';
        }

        $content->attribs = json_decode($content->attribs);

        return $content;
    }

    public function getWhereIn($ids) {
        return $this->_contentRepQuery->getWhereIn($ids);
    }

    public function getByAlias($alias) {
        $data = $this->_contentRepQuery->getByAlias($alias);
        $data->layout = json_decode($data->layout);
        return $data;
    }

    public function getTotal() {
        return $this->_contentRepQuery->getTotal();
    }

    public function getListByCategoryId($id) {
        return $this->_contentRepQuery->getListByCategoryId($id);
    }

    public function getListAncestorsByCateId($id) {
        $serviceCate = new CategoriesServiceQuery();

        $ids = [];
        $listIds = $serviceCate->getDescendantsAndSelf($id);
        if (empty($listIds)) {
            return [];
        }

        foreach ($listIds as $id) {
            $ids[] = $id->id;
        }

        return $this->getWhereIn($ids);
    }

    public function getListByWidget($input) {
        $result = [];
        $list = $this->_contentRepQuery->getListByWidget($input);
        foreach ($list as $item) {
            $item->attribs = json_decode($item->attribs);
            $result[] = $item;
        }

        return $result;
    }
}
