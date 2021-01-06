<?php

namespace App\Modules\Application\Controllers\Frontend;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use App\Modules\Domain\Models\Products;
use App\Modules\Domain\Services\Queries\WidgetsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
class HomeController extends IController
{
    public function index()
    {

        $result = [
            'list' => '',
            'not_col' => 1
        ];

            $service = new ProductsServiceQuery();

            $result['list'] = Products::all();

            foreach ($result['list'] as &$item) {
                $item['images'] = explode(',', $item['images']);
            }


        return iView('home', [
            'meta' => $this->meta,
            'data' => $result
        ]);
    }
}
