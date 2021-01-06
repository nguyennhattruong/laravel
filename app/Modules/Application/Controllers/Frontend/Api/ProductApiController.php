<?php

namespace App\Modules\Application\Controllers\Frontend\Api;


use App\Modules\Infrastructure\Core\IController;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use Illuminate\Http\Request;

class ProductApiController extends IController
{

    function __construct() {
        parent::__construct();
        $this->_serviceQuery = new ProductsServiceQuery();
    }

    public function getListProductByPageAndCategory(Request $request)
    {
//        $data = $view->offsetGet('wid_content');
        $id = $request->id;
        $products = $this->_serviceQuery->getListForFrontend($id);
//        $data = $view->offsetGet('wid_content');
//        var_dump($data); die;
        return iView('ajax.load', ['data' => $products]);
//        return response()->json([
//            'result' => $products,
//        ]);
    }
}
