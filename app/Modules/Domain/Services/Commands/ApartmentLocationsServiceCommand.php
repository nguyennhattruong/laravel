<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ApartmentLocationsRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ApartmentLocationsServiceCommand extends ServiceCommand
{
    private $_repCommand;

    function __construct() {
        $this->_repCommand = new ApartmentLocationsRepositoryCommand();
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
}
