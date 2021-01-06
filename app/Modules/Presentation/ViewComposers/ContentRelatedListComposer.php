<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use Illuminate\View\View;

class ContentRelatedListComposer
{
    public function compose(View $view) {
        $data = $view->offsetGet('wid_content');

        $result = [
            'list' => [],
            'category_alias' => ''
        ];

        $service = new ContentServiceQuery();
        $service_cate = new CategoriesServiceQuery();

        // Get alias
        $alias = collect(request()->segments())->last();
        $content = $service->getByAlias($alias);

        $result['list'] = $service->getListByWidget([
            'category' => $content->category_id,
            'quantity' => $data['params']->quantity
        ]);

        $result['category_alias'] = $service_cate->getById($content->category_id)->alias;

        $view->with('data', $result);
    }
}
