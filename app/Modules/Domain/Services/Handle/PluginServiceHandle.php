<?php

namespace App\Modules\Domain\Services\Handle;

use App\Modules\Infrastructure\Core\Domain\ServiceHandle;

class PluginServiceHandle extends ServiceHandle
{
    public function getPlugins() {
        return config('define.plugins');
    }
}