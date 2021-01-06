<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ProductsCategoriesRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ProductsCategoriesServiceCommand extends ServiceCommand
{
    private $_repCommand;

    function __construct() {
        $this->_repCommand = new ProductsCategoriesRepositoryCommand();
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

    public function trash($id) {
        return $this->_repCommand->trash($id);
    }

    public function restore($id) {
        return $this->_repCommand->restore($id);
    }

    public function update_status($id, $cate_id) {
        return $this->_repCommand->update_status($id, $cate_id);
    }
}
