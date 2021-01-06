<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;
use Illuminate\Support\Facades\DB;

class AttributesValuesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getListByAttributeId() {
        return DB::table('co_attributes_values')
                    ->join('co_attributes', 'co_attributes_values.attribute_id', '=', 'co_attributes.id')
                    ->select('co_attributes_values.*')
                    ->where('co_attributes.column_name', '=', 'utility')
                    ->get();
    }
}
