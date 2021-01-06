<?php

namespace App\Modules\Application\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Repositories\Queries\UsersGroupsRepositoryQuery;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin';

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:100|unique:co_users',
            'password' => 'required|string|min:1|confirmed',
        ]);
    }

    protected function create(array $data) {
        return \App\Modules\Domain\Models\User::create([
            'name' => $data['name'],
            'fullname' => $data['fullname'],
            'email' => '',
            'password' => bcrypt($data['password']),
            'group_id' => $data['group_id'],
            'remark' => isset($data['remark']) ? $data['remark'] : ''
        ]);
    }

    public function showRegistrationForm() {
        $service = new UsersGroupsRepositoryQuery();
        return view('Backend::auth.register', [
            'group' => $service->getListForControl()
        ]);
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect()->route('UsersIndex');
    }
}
