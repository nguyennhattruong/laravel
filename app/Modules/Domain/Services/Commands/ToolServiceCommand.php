<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Infrastructure\Core\Domain\ServiceCommand;
use DirectoryIterator;

class ToolServiceCommand extends ServiceCommand
{
    /**
     * Clean temp files
     *
     * @author nhat_truong
     * @since 2017-12-04
     */
    public function cleanTempFile() {
        if (!file_exists($path = base_path('uploads\tmp'))) {
            mkdir($path, 0777, true);
        }

        foreach (new DirectoryIterator($path) as $file) {
            if (!$file->isDot() && !$file->isDir() && $file->getFileName() != 'index.html') {
                unlink($file->getPathname());
            }
        }
    }
}
