<?php

namespace App\Modules\Domain\Services\Queries;

use App\Modules\Domain\Models\UsersGroups;
use App\Modules\Domain\Repositories\Queries\UsersGroupsRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\ServiceQuery;

class UsersGroupsServiceQuery extends ServiceQuery
{
    private $_repositories;

    function __construct() {
        $this->_repositories = new UsersGroupsRepositoryQuery();
    }

    public function getList($input) {
        return $this->_repositories->getList($input);
    }

    public function getListForControl($current_id = NULL) {
        $result = [];
        $list = $this->_repositories->getListForControl($current_id);

        foreach ($list as $item) {
            $result[$item['id']] = str_repeat('- ', $item['depth']) . $item['title'];
        }

        return $result;
    }

    public function getById($id) {
        $user = UsersGroups::find($id);
        $user->rules = json_decode($user->rules);
        return $user;
    }

    public function getByAlias($alias) {
        return $this->_repositories->getByAlias($alias);
    }

    public function getTotal() {
        return $this->_repositories->getTotal();
    }

    public function getAncestors($id) {
        return UsersGroups::find($id)->getAncestors();
    }

    public function getSiblingsAndSelf($id) {
        return UsersGroups::find($id)->getSiblingsAndSelf();
    }

    public function getAncestorsAndSelf($id) {
        return UsersGroups::find($id)->getAncestorsAndSelf();
    }

    public function getDescendantsAndSelf($id) {
        return UsersGroups::find($id)->getDescendantsAndSelf();
    }
}
