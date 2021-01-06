<?php

namespace App\Modules\Application\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Services\Commands\ApartmentServiceCommand;

class ApartmentApiController extends Controller
{
    public function destroyImage($product_id, $name) {
        $service = new ApartmentServiceCommand();
        return response()->json($service->deleteImage($product_id, $name));
    }
}
