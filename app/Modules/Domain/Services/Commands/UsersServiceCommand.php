<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\UsersRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class UsersServiceCommand extends ServiceCommand
{
    private $_rep;

    function __construct() {
        $this->_rep = new UsersRepositoryCommand();
    }

    public function insert($content) {
        return $this->_rep->insert($content);
    }

    public function update($content) {
        return $this->_rep->update($content);
    }

    public function delete($id) {
        return $this->_rep->delete($id);
    }

    public function update_print($id) {
        return $this->_rep->update_print($id);
    }
}
