<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Pages;
use App\Modules\Domain\Services\Queries\PagesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class PagesRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    protected function _getData($input, $type = 'insert') {
        switch ($type) {
            case 'insert':
                $page = new Pages();
                break;
            case 'update':
                $service = new PagesServiceQuery();
                $page = $service->getById($input['id']);
                break;
            default:
                return NULL;
        }

        $page = $this->setAttributes($page, $input);
        $page->status = $this->getStatus($input['status']);
        $page->language = $this->getLang($input['language']);

        $attrs = [];
        foreach ($input['attr_key'] as $key => $value) {
            if (!is_null($value)) {
                $attrs[$value] = $input['attr_value'][$key];
            }
        }

        $page->attribs = '';
        if (!empty($attrs)) {
            $page->attribs = json_encode($attrs);
        }

        return $page;
    }

    public function insert($item) {
        $pages = $this->_getData($item);
        return $pages->save();
    }

    public function update($item) {
        $pages = $this->_getData($item, 'update');
        return $pages->save();
    }

    public function delete($id) {
        return Pages::destroy($id);
    }

    public function updateStatus($id, $status) {
        return Pages::where('id', $id)->update(['status' => $status]);
    }
}
