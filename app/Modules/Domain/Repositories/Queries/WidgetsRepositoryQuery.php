<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\Widgets;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class WidgetsRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getListByPosition($position) {
        $where = [
            'position' => $position
        ];

        return Widgets::where($where)->orderBy('ordering')->get()->toArray();
    }

    public function getById($id) {
        return Widgets::find($id);
    }

    public function getByListId($ids) {
        return Widgets::whereIn('id', $ids)->get();
    }
}
