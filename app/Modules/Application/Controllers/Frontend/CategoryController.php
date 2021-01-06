<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class CategoryController extends IController
{
    private $_service;

    function __construct() {
        parent::__construct();
        $this->_service = new CategoriesServiceQuery();
    }

    public function category($alias) {
        $serviceContent = new ContentServiceQuery();
        $info = $this->_service->getByAlias($alias);

        if (empty($info)) {
            return $this->redirectHome();
        }

        $siblings = $this->_service->getAncestors($info->id);

        return iView('content.category', [
            'data' => $serviceContent->getListAncestorsByCateId($info->id),
            'info' => $info,
            'siblings' => $siblings
        ]);
    }
}
