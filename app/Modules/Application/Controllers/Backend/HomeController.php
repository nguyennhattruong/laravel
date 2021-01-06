<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class HomeController extends IController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = new ContentServiceQuery();
        $categories = new CategoriesServiceQuery();

        return view('Backend::home.index', [
            'data' => [
                'total_content' => $content->getTotal(),
                'total_categories' => $categories->getTotal()
            ]
        ]);
    }
}
