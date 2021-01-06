<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use Illuminate\View\View;

class ProductsListComposer
{
    public function compose(View $view)
    {
        $data = $view->offsetGet('wid_content');

        $result = [
            'list' => '',
            'category_alias' => ''
        ];

        if (!empty($data['params']->category)) {
            $service = new ProductsServiceQuery();
            $service_cate = new ProductsCategoriesServiceQuery();

            $result['list'] = $service->getListByWidget([
                'category' => $data['params']->category,
                'quantity' => $data['params']->quantity
            ]);

            foreach ($result['list'] as &$item) {
                $item['images'] = explode(',', $item['images']);
            }
            $result['category_alias'] = $service_cate->getById($data['params']->category)->alias;
            $result['category_id'] = $data['params']->category;
        }

        // Convert images
//dd($result);
        $view->with('data', $result);
    }
}
