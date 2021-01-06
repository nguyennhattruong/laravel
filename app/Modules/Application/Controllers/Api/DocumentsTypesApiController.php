<?php

namespace App\Modules\Application\Controllers\Api;

use App\Modules\Domain\Services\Commands\Documents\DocumentsTypesServiceCommand;
use App\Modules\Infrastructure\Core\IController;

class DocumentsTypesApiController extends IController
{
    public function delete($id) {
        $service = new DocumentsTypesServiceCommand();
        return $service->delete($id);
    }
}
