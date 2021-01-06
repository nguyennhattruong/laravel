<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\MenuTypes;
use App\Modules\Domain\Services\Commands\MenuTypesServiceCommand;
use App\Modules\Domain\Services\Queries\MenuTypesServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\MenuTypes\MenuTypesEditForm;
use App\Modules\Presentation\Forms\Backend\MenuTypes\MenuTypesIndexForm;
use App\Modules\Presentation\Forms\Backend\MenuTypes\MenuTypesIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MenuTypesController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    public function index(Request $request) {
        $service = new MenuTypesServiceQuery();

        return view('Backend::menu_types.index', [
            'form' => $this->form(MenuTypesIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(MenuTypesIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form(MenuTypesEditForm::class, [
            'model' => new MenuTypes()
        ]);

        return view('Backend::menu_types.edit', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $input = $request->input();

        $form = $this->form(MenuTypesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        $service = new MenuTypesServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('MenuTypesInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new MenuTypesServiceQuery();

        if (empty($info = $service->getById($id))) {
            return redirect()->route('MenuTypesIndex');
        }

        $form = $this->form(MenuTypesEditForm::class, [
            'model' => $info
        ]);

        return view('Backend::menu_types.edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $service = new MenuTypesServiceQuery();

        if (empty($info = $service->getById($id))) {
            return redirect()->route('MenuTypesIndex');
        }

        $form = $this->form(MenuTypesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        $serviceCommand = new MenuTypesServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('MenuTypesEdit', $info->id);
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * Trash, Restore, Update Status, delete
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('MenuTypesIndex');
    }

    private function _delete(Request $request) {
        $service = new MenuTypesServiceCommand();
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
