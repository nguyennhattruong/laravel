<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use Illuminate\View\View;

class NavbarVerticalComposer
{
    public function compose(View $view)
    {
        $html = '';
        $data = $view->offsetGet('wid_content');

        if (isset($data['params']->menutype_id)) {
            $service = new MenuServiceQuery();
            $html = $service->getHtmlMenuVertical($data['params']->menutype_id);
        }

        $view->with('data', $html);
    }
}
