<?php

namespace App\Modules\Presentation\ViewComposers\Plugins;

use Illuminate\View\View;

class RegisterMailComposer
{
    public function compose(View $view) {
        $data = config('define.plugins.register_mail_popup.data');
        $view->with('data', $data);
    }
}
