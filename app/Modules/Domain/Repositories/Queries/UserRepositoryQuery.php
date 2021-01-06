<?php

namespace App\Modules\Domain\Repositories\Queries;

use App\Modules\Domain\Models\User;
use App\Modules\Infrastructure\Core\Domain\RepositoryQuery;

class UserRepositoryQuery extends RepositoryQuery
{
    function __construct() {
    }

    public function getList($request) {
        $defaults = [
            'name' => 'like',
        ];

        $conditions = $this->getCondition($defaults, $request->input());
        $display = $this->getDisplay($request['display']);

        return User::sortable()->select('*')
                               ->where($conditions)
                               ->orderBy('id', 'DESC')
                               ->paginate($display);
    }

    public function getById($id) {
        return User::find($id);
    }

    public function hasByName($name) {
        return User::where('name', $name)->get();
    }
}
