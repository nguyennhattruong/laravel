<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Infrastructure\Core\Domain\ServiceQuery;
use DirectoryIterator;

class ToolServiceQuery extends ServiceQuery
{
    /**
     * Get Total temp files
     *
     * @return array
     * @author nhat_truong
     * @since 2017-12-03
     */
    public function getTotal() {
        $value = 0;
        $count = 0;
        $files = array();

        if (!file_exists($path = base_path('uploads\tmp'))) {
            mkdir($path, 0777, true);
        }

        foreach (new DirectoryIterator($path) as $file) {
            if (!$file->isDot() && !$file->isDir() && $file->getFileName() != 'index.html') {
                $files[] = str_replace('/', '\\', $file->getPathname());
                $value += $file->getSize();
                $count++;
            }
        }

        $value = round($value / 1048576, 2) . ' MB';

        return compact('value', 'count', 'files');
    }
}
