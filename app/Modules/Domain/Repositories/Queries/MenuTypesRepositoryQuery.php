<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\MenuTypes;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class MenuTypesRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
        ];

        $conditions = $this->getCondition($defaults, $request);
        if (!empty($lang = $this->getConditionLanguage($request->input('language')))) {
            $conditions[] = $lang;
        }

        $display = $this->getDisplay($request->input('display'));

        return MenuTypes::sortable()->where($conditions)
                                    ->paginate($display);
    }

    public function getAll() {
        return MenuTypes::all()->toArray();
    }

    public function getAllForControl() {
        return MenuTypes::pluck('title', 'id')->toArray();
    }
}
