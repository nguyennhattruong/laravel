<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Admissions;
use App\Modules\Domain\Models\User;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class UsersRepositoryCommand extends RepositoryCommand
{
    public function update($input) {
        $admissions = User::find($input['id']);

        if (trim($input['password'] != '')) {
            $admissions->password = bcrypt($input['password']);
        }

        $admissions->remark = $input['remark'] ? $input['remark'] : '';
        $admissions->name = $input['name'];
        $admissions->fullname = $input['fullname'];
        $admissions->group_id = $input['group_id'];

        return $admissions->save();
    }

    public function delete($id) {
        if ($id != 1) {
            return User::destroy($id);
        }
        return false;
    }
}
