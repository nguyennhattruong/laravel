<?php

namespace App\Modules\Policies;

use App\Modules\Domain\Models\Documents\Documents;
use App\Modules\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DocumentsPolicy
{
    use HandlesAuthorization;

    public function before() {
        $user = Auth::user();
        $rules = array_flip(json_decode($user->group->rules));
        if (isset($rules['full_doc'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param Documents $documents
     * @return mixed
     */
    public function view(User $user, Documents $documents)
    {
        return $user->id == $documents->created_by;
    }

    /**
     * Determine whether the user can create documents.
     *
     * @param  \App\Modules\Domain\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param Documents $documents
     * @return mixed
     */
    public function update(User $user, Documents $documents)
    {
        return $user->id == $documents->created_by;
    }

    /**
     * Determine whether the user can delete the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param Documents $documents
     * @return mixed
     */
    public function delete(User $user, Documents $documents)
    {
        return $user->id == $documents->created_by;
    }

    public function updateStatus(User $user)
    {
        return $user->hasPermission('update_status');
    }

    public function updatePosition(User $user)
    {
        return $user->hasPermission('update_position');
    }

    public function updateRemark(User $user)
    {
        return $user->hasPermission('update_remark');
    }
}
