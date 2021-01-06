<?php

namespace App\Modules\Infrastructure\Core\Domain;

class Repository
{
    /**
     * Get table name as on Database
     *
     * @param $class
     * @return mixed
     * @author nhat_truong
     * @since  2018-01-12
     */
    public function getTable($class) {
        return with(new $class)->getTable();
    }
}
