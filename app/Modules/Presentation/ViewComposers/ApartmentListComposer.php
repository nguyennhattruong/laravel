<?php

namespace App\Modules\Presentation\ViewComposers;

use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Domain\Services\Queries\ApartmentServiceQuery;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ApartmentListComposer
{
    public function compose(View $view) {

        $service = new ApartmentServiceQuery();

        $data = $view->offsetGet('wid_content');

        $result = [];

        if (!empty($data['params']->type_id)) {
            $input['type_id'] = $data['params']->type_id;
        }

        if (!empty($data['params']->location_id)) {
            if ($data['params']->location_id == 'current'
                && Route::currentRouteName() == 'FrontApartmentLocationsDetail') {

                // Get current location
                $alias = Route::current()->parameters['alias'];
                $locationService = new ApartmentLocationsServiceQuery();
                if (!empty($location = $locationService->getByAlias($alias))) {
                    $input['location_id'] = $location->id;

                    $result['header_title'] = $location->name;
                }
            } else {
                $input['location_id'] = $data['params']->location_id;
            }
        }

        $input['quantity'] = $data['params']->quantity;

        $result = $result + [
            'list' => $service->getListByWidget($input),
            'apartment_type_alias' => ''
        ];

        $view->with('data', $result);
    }
}
