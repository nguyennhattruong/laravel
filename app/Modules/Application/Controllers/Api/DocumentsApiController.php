<?php

namespace App\Modules\Application\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Services\Commands\Documents\DocumentsServiceCommand;
use Illuminate\Http\Request;

class DocumentsApiController extends Controller
{
    private $_serviceCommand = NULL;

    public function __construct() {
        $this->_serviceCommand = new DocumentsServiceCommand();
    }

    public function delete($id) {
        return $this->_serviceCommand->delete($id);
    }

    public function update(Request $request, $id) {
        $input = $request->input();
        return $this->_serviceCommand->updateApi($input, $id);
    }
}
