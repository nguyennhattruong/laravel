<?php

namespace App\Modules\Application\Controllers\Api;

use App\Modules\Domain\Services\Commands\Documents\DocumentsDepartmentsServiceCommand;
use App\Modules\Infrastructure\Core\IController;

class DocumentsDepartmentsApiController extends IController
{
    public function delete($id) {
        $service = new DocumentsDepartmentsServiceCommand();
        return $service->delete($id);
    }
}
