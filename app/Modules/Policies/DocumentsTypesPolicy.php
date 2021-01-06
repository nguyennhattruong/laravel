<?php

namespace App\Modules\Policies;

use App\Modules\Domain\Models\Documents\Documents;
use App\Modules\Domain\Models\Documents\DocumentsTypes;
use App\Modules\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DocumentsTypesPolicy
{
    use HandlesAuthorization;

    public function before() {
        $user = Auth::user();
        $rules = array_flip(json_decode($user->group->rules));
        if (isset($rules['full_doc'])) {
            return true;
        }
    }

    public function index(User $user, DocumentsTypes $documents)
    {
        return $user->hasPermission('full_doc_type');
    }

    /**
     * Determine whether the user can view the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param DocumentsTypes $documents
     * @return mixed
     */
    public function view(User $user, DocumentsTypes $documents)
    {
        return $user->id == $documents->created_by;
    }

    /**
     * Determine whether the user can create documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param DocumentsTypes $documents
     * @return mixed
     */
    public function create(User $user, DocumentsTypes $documents)
    {
        return $user->hasPermission('full_doc_type');
    }

    /**
     * Determine whether the user can update the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param DocumentsTypes $documents
     * @return mixed
     */
    public function update(User $user, DocumentsTypes $documents)
    {
        return $user->id == $documents->created_by;
    }

    /**
     * Determine whether the user can delete the documents.
     *
     * @param  \App\Modules\Domain\Models\User $user
     * @param DocumentsTypes $documents
     * @return mixed
     */
    public function delete(User $user, DocumentsTypes $documents)
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
