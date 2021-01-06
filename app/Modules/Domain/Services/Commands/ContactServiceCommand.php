<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ContactRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ContactServiceCommand extends ServiceCommand
{
    private $_repCommand;

    function __construct() {
        $this->_repCommand = new ContactRepositoryCommand();
    }

    public function insert($contact) {
        return $this->_repCommand->insert($contact);
    }
}
