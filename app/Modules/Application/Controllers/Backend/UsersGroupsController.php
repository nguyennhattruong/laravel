<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\UsersGroups;
use App\Modules\Domain\Services\Commands\CategoriesServiceCommand;
use App\Modules\Domain\Services\Commands\UsersGroupsServiceCommand;
use App\Modules\Domain\Services\Queries\UsersGroupsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\UsersGroups\UsersGroupsEditForm;
use App\Modules\Presentation\Forms\Backend\UsersGroups\UsersGroupsIndexForm;
use App\Modules\Presentation\Forms\Backend\UsersGroups\UsersGroupsIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class UsersGroupsController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
        $this->init();
    }

    public function init() {
        $this->_formEdit       = UsersGroupsEditForm::class;
        $this->_formIndexGrid  = UsersGroupsIndexGridForm::class;
        $this->_viewIndex      = 'Backend::users_groups.index';
        $this->_viewEdit       = 'Backend::users_groups.edit';
        $this->_serviceQuery   = new UsersGroupsServiceQuery();
        $this->_serviceCommand = new UsersGroupsServiceCommand();
        $this->_model          = new UsersGroups();
        $this->_routeInsert    = 'UsersGroupsInsert';
        $this->_routeEdit      = 'UsersGroupsEdit';
        $this->_routeIndex     = 'UsersGroupsIndex';
    }

    public function index(Request $request) {
        return view($this->_viewIndex, [
            'formGrid' => $this->form($this->_formIndexGrid, ['model' => $request]),
            'data' => $this->_serviceQuery->getList($request)
        ]);
    }

    public function manage(Request $request) {
        if (isset($request['form_action'])) {
            switch ($request['form_action']) {
                case 'delete':
                    return $this->_delete($request);
                    break;
                default:
                    break;
            }
        }

        return redirect()->route($this->_routeIndex);
    }

    private function _delete(Request $request) {
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$this->_serviceCommand->delete($id)) {
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
