<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\WidgetsServiceQuery;
use Illuminate\View\View;

class WidgetSingleComposer
{
    public function compose(View $view) {
        $id = $view->offsetGet('id');
        $service = new WidgetsServiceQuery();
        $data = $service->getByIdForShow($id);
        $view->with('data', $data);
    }
}
