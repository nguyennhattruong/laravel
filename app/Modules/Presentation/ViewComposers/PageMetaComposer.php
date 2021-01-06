<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\ConfigServiceQuery;
use Illuminate\View\View;

class PageMetaComposer
{
    public function compose(View $view)
    {
        if (!$view->offsetExists('meta')) {
            $service = new ConfigServiceQuery();
            $view->offsetSet('meta', $service->getPageMeta());
        }
    }
}
