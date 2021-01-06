<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\UsersGroups;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class UsersGroupsRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'title' => 'like',
        ];

        $conditions = $this->getCondition($defaults, $request);
        $display = $this->getDisplay($request->input('display'));

        return UsersGroups::sortable()->where($conditions)
                                      ->orderBy('lft', 'ASC')
                                      ->paginate($display);
    }

    public function getListForControl($current_id = NULL) {
        $table = getTable(UsersGroups::class);

        if (!is_null($current_id)) {
            $current = UsersGroups::find($current_id);

            return UsersGroups::whereRaw("id NOT IN (SELECT id 
                                                        FROM {$table} 
                                                        WHERE lft >= {$current->lft} 
                                                            AND rgt <= {$current->rgt})")->get()->sortBy('lft');
        } else {
            return UsersGroups::all()->toArray();
        }
    }

    public function getTotal() {
        return UsersGroups::count();
    }

    public function getByAlias($alias) {
        return UsersGroups::where([
            'alias' => $alias
        ])->first();
    }
}

