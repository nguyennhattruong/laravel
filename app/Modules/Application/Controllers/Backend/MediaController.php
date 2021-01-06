<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Infrastructure\Core\IController;

class MediaController extends IController
{
    public function index()
    {
        return view('Backend::media.index');
    }
}
