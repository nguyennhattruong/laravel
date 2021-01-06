<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class ContactController extends IController
{
    private $_service;

    function __construct() {
        parent::__construct();
//        $this->_service = new ContentServiceQuery();
    }

    public function index()
    {
        return iView('layouts.contact', [
//            'meta' => $this->meta
        ]);
    }
}
