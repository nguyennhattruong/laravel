<?php

namespace App\Modules\Presentation\ViewComposers;

use Illuminate\View\View;

class CustomHtmlComposer
{
    public function compose(View $view)
    {
        $data = $view->offsetGet('wid_content');
        $view->with("data", $data['content']);
    }
}
