<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\UsersGroups;
use App\Modules\Domain\Services\Queries\UsersGroupsServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class UsersGroupsRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    public function insert($input) {
        $group = new UsersGroups();
        $group = $this->setAttributes($group, $input);

        if (isset($input['rules'])) {
            $group->rules = json_encode($input['rules']);
        }

        if ($group->save()) {
            $group->save();
            return $group->makeRoot();
        }

        return false;
    }

    public function update($input) {
        $service = new UsersGroupsServiceQuery();
        $node = $service->getById($input['id']);
        $node = $this->setAttributes($node, $input);
        $node->rules = '';

        if (isset($input['rules'])) {
            $node->rules = json_encode($input['rules']);
        }

        return $node->save();
    }

    public function delete($id) {
        return UsersGroups::destroy($id);
    }
}
