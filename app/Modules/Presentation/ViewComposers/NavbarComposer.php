<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view)
    {
        $list = [];
        $data = $view->offsetGet('wid_content');

        if (isset($data['params']->menutype_id)) {
            $service = new MenuServiceQuery();
            $list = $service->getHtmlMenu($data['params']->menutype_id);
        }
        $view->with('data', $list);
    }
}
