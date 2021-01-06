<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\CategoriesRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class CategoriesServiceCommand extends ServiceCommand
{
    private $_categoriesRepCommand;

    function __construct() {
        $this->_categoriesRepCommand = new CategoriesRepositoryCommand();
    }

    public function insert($content) {
        return $this->_categoriesRepCommand->insert($content);
    }

    public function update($content) {
        return $this->_categoriesRepCommand->update($content);
    }

    public function delete($id) {
        return $this->_categoriesRepCommand->delete($id);
    }

    public function trash($id) {
        return $this->_categoriesRepCommand->trash($id);
    }

    public function restore($id) {
        return $this->_categoriesRepCommand->restore($id);
    }

    public function update_status($id, $cate_id) {
        return $this->_categoriesRepCommand->update_status($id, $cate_id);
    }
}
