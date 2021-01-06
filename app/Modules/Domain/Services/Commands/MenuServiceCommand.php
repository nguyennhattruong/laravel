<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\MenuRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class MenuServiceCommand extends ServiceCommand
{
    private $_repCommand;

    function __construct() {
        $this->_repCommand = new MenuRepositoryCommand();
    }

    public function insert($content) {
        return $this->_repCommand->insert($content);
    }

    public function update($content) {
        return $this->_repCommand->update($content);
    }

    public function delete($id) {
        return $this->_repCommand->delete($id);
    }

    public function update_status($id, $status) {
        return $this->_repCommand->update_status($id, $status);
    }
}
