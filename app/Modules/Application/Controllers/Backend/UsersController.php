<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\CategoriesRequest;
use App\Modules\Domain\Services\Commands\UsersServiceCommand;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use App\Modules\Domain\Services\Queries\UserServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Admissions\CategoriesEditForm;
use App\Modules\Presentation\Forms\Backend\Users\UsersEditForm;
use App\Modules\Presentation\Forms\Backend\Users\UsersIndexForm;
use App\Modules\Presentation\Forms\Backend\Users\UsersIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class UsersController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $service = new UserServiceQuery();

        return view('Backend::users.index', [
            'form' => $this->form(UsersIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(UsersIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    public function edit($id) {
        $service = new UserServiceQuery();

        if (empty($info = $service->getById($id))) {
            return redirect()->route('UsersIndex');
        }
        $info->password = '';
        $info->password = '';
        $info->rules = explode(',', $info->rules);
        $form = $this->form(UsersEditForm::class, [
            'model' => $info
        ]);

        return view('Backend::users.edit', [
            'form' => $form,
            'id' => $id,
            'permissions' => [
                'admin/admissions' => 'Danh sách thí sinh',
                'admin/admissions?is_print=1' => 'Danh sách thí sinh đã in',
                'admin/admissions/highschool' => 'Danh sách trường THPT',
                'admin/users' => 'Danh sách tài khoản',
            ]
        ]);
    }

    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $service = new UserServiceQuery();

        if (empty($info = $service->getById($id))) {
            return redirect()->route('UsersIndex');
        }

        $form = $this->form(UsersEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        $serviceCommand = new UsersServiceCommand();

        if (trim($input['password']) != '') {
            if (trim($input['password']) != trim($input['password_confirmation'])) {
                return $this->error('Mật khẩu xác nhận không đúng!');
            }
        }

        if ($input['name'] != $info->name) {
            if (empty($service->hasByName($input['name']))) {
                return $this->error('Tài khoản đã tồn tại');
            }
        }

        if ($serviceCommand->update($input)) {
            return $this->successSave('UsersEdit', $info->id);
        } else {
            return $this->errorSave($input);
        }
    }

    public function manage(CategoriesRequest $request) {
        if (isset($request['form_action'])) {
            switch ($request['form_action']) {
                case 'update_status':
                    return $this->_update_status($request);
                    break;
                case 'delete':
                    return $this->_delete($request);
                    break;
                default:
                    break;
            }
        }

        return redirect()->route('UsersIndex');
    }

    private function _update_status(CategoriesRequest $request) {
        $service = new ProductsServiceQuery();
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$service->update_status($id, $request->input('status_to'))) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorSaveList($errors);
        } else {
            return $this->successSave();
        }
    }

    private function _delete(CategoriesRequest $request) {
        $service = new UsersServiceCommand();
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$service->delete($id)) {
                $errors[] = $id;
            }
        }

        if (!empty($errors)) {
            return $this->errorDeleteList($errors);
        } else {
            return $this->successSave();
        }
    }
}
