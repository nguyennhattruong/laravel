<?php

namespace App\Modules\Infrastructure\Core\Domain;

class ServiceQuery
{
    protected $_repository;

    public function getById($id) {
        return $this->_repository->getById($id);
    }
}
