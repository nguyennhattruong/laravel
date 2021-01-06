<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\WidgetsServiceQuery;
use Illuminate\View\View;

class WidgetAreaComposer
{
    public function compose(View $view)
    {
        $position = $view->offsetGet('position');

        $service = new WidgetsServiceQuery();
        $list = $service->getListByPosition($position);

        $view->with('data', $list);
    }
}
