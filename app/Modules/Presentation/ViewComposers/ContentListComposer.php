<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use Illuminate\View\View;

class ContentListComposer
{
    public function compose(View $view)
    {
        $data = $view->offsetGet('wid_content');

        $result = [
            'list' => '',
            'category_alias' => ''
        ];

        if (!empty($data['params']->category)) {
            $service = new ContentServiceQuery();
            $service_cate = new CategoriesServiceQuery();

            $result['list'] = $service->getListByWidget([
                'category' => $data['params']->category,
                'quantity' => $data['params']->quantity
            ]);

            $result['category_alias'] = $service_cate->getById($data['params']->category)->alias;
        }

        $view->with('data', $result);
    }
}
