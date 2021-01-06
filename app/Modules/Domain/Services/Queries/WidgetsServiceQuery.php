<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Repositories\Queries\WidgetsRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class WidgetsServiceQuery extends ServiceQuery
{
    private $_service;

    function __construct() {
        $this->_service = new WidgetsRepositoryQuery();
    }

    public function getListByPosition($position) {
        $list = $this->_service->getListByPosition($position);
        $result = [];

        foreach ($list as $item) {
            $temp = $item;
            $temp['params'] = json_decode($item['params']);
            $temp['options'] = json_decode($item['options']);
            $result[] = $temp;
        }

        return $result;
    }

    public function getById($id) {
        $data = $this->_service->getById($id);
        return $data;
    }

    public function getByIdForShow($id) {
        $data = $this->_service->getById($id);
        $data['params'] = json_decode($data['params']);
        $data['options'] = json_decode($data['options']);
        return $data;
    }

    public function getByIdForEdit($id) {
        $data = $this->getById($id);
        $data['params'] = json_decode($data['params']);

        $options = json_decode($data['options']);

        $data['session_class'] = (isset($options->session->class)) ? $options->session->class : '';
        $data['session_attr'] = (isset($options->session->attr)) ? $options->session->attr : '';
        $data['header_class'] = (isset($options->header->class)) ? $options->header->class : '';
        $data['header_attr'] = (isset($options->header->attr)) ? $options->header->attr : '';
        $data['body_class'] = (isset($options->body->class)) ? $options->body->class : '';
        $data['body_attr'] = (isset($options->body->attr)) ? $options->body->attr : '';
        return $data;
    }

    public function getByListId($ids) {
        return $this->_service->getByListId($ids);
    }
}
