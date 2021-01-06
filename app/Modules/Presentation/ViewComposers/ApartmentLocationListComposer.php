<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use Illuminate\View\View;

class ApartmentLocationListComposer
{
    public function compose(View $view) {

        $service = new ApartmentLocationsServiceQuery();

        $data = $view->offsetGet('wid_content');

        $result = [
            'list' => $service->getListFrontend($data['params']->quantity),
            'apartment_type_alias' => ''
        ];

        $view->with('data', $result);
    }
}
