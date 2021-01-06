<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Content;
use App\Modules\Domain\Models\MenuTypes;
use App\Modules\Domain\Services\Queries\MenuTypesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class MenuTypesRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    /**
     * Create object for insert, update
     *
     * @param $input
     * @param string $type
     * @return Content|\App\Modules\Infrastructure\Core\Domain\Model
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    protected function _getData($input, $type = 'insert') {
        switch ($type) {
            case 'insert':
                $content = new MenuTypes();
                break;
            case 'update':
                $service = new MenuTypesServiceQuery();
                $content = $service->getById($input['id']);
                break;
            default:
                return null;
        }

        $fields = ['title', 'description'];
        $content = $this->getItems($content, $fields, $input);
        $content->language = $this->getLang($input['language']);

        return $content;
    }

    /**
     * @param $item
     * @return mixed
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    public function insert($item) {
        return $this->_getData($item)->save();
    }

    /**
     * @param $item
     * @return mixed
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    public function update($item) {
        return $this->_getData($item, 'update')->save();
    }

    /**
     * @param $id
     * @return int
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    public function delete($id) {
        return MenuTypes::destroy($id);
    }
}
