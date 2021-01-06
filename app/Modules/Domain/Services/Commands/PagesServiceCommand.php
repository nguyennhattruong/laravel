<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\PagesRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class PagesServiceCommand extends ServiceCommand
{
    private $_repCommand;

    function __construct() {
        $this->_repCommand = new PagesRepositoryCommand();
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

    public function updateStatus($id, $cate_id) {
        return $this->_repCommand->updateStatus($id, $cate_id);
    }
}
