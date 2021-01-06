<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ContentRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ContentServiceCommand extends ServiceCommand
{
    private $_contentRepCommand;

    function __construct() {
        $this->_contentRepCommand = new ContentRepositoryCommand();
    }

    public function insert($content) {
        return $this->_contentRepCommand->insert($content);
    }

    public function update($content) {
        return $this->_contentRepCommand->update($content);
    }

    public function delete($id) {
        return $this->_contentRepCommand->delete($id);
    }

    public function trash($id) {
        return $this->_contentRepCommand->trash($id);
    }

    public function restore($id) {
        return $this->_contentRepCommand->restore($id);
    }

    public function update_cate($id, $cate_id) {
        return $this->_contentRepCommand->update_cate($id, $cate_id);
    }

    public function update_status($id, $cate_id) {
        return $this->_contentRepCommand->update_status($id, $cate_id);
    }
}
