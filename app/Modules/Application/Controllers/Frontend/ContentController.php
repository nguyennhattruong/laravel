<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class ContentController extends IController
{
    private $_service;

    function __construct() {
        parent::__construct();
        $this->_service = new ContentServiceQuery();
    }

    public function index()
    {
        $service = new ContentServiceQuery();
        $content = $service->getTotal();

        $serviceCate = new CategoriesServiceQuery();
//        $categories = $serviceCate->getAncestorsAndSelf($content->category_id);

        return iView('widgets.content_list', [
            'data' => $content,
//            'cate' => $categories,
        ]);
    }

    public function show($alias)
    {
        $service = new ContentServiceQuery();
        $content = $service->getByAlias($alias);

        $serviceCate = new CategoriesServiceQuery();
        $categories = $serviceCate->getAncestorsAndSelf($content->category_id);

        return iView('content.content', [
            'data' => $content,
            'cate' => $categories,
        ]);
    }
}
