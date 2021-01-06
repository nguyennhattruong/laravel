<?php

namespace App\Modules\Domain\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;

    protected $table = 'co_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'fullname', 'email', 'password', 'group_id', 'remark'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->hasOne('App\Modules\Domain\Models\UsersGroups', 'id', 'group_id');
    }

    public function hasPermission($rule) {
        $rules = array_flip(json_decode(Auth::user()->group->rules));
        if (isset($rules[$rule])) {
            return true;
        }
        return false;
    }
}
