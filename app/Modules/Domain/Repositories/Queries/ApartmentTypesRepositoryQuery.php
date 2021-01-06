<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\ApartmentTypes;
use App\Modules\Domain\Services\Queries\ApartmentCategoriesServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class ApartmentTypesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function findByAlias($alias) {

        $where = [
            'alias' => $alias,
            'status' => 1
        ];

        return ApartmentTypes::where($where)->first();
    }

    public function finAll() {
        return ApartmentTypes::all();
    }
}
