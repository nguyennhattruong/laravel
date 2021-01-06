<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\UsersGroupsRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class UsersGroupsServiceCommand extends ServiceCommand
{
    private $_repository;

    function __construct() {
        $this->_repository = new UsersGroupsRepositoryCommand();
    }

    public function insert($content) {
        return $this->_repository->insert($content);
    }

    public function update($content) {
        return $this->_repository->update($content);
    }

    public function delete($id) {
        return $this->_repository->delete($id);
    }
}
