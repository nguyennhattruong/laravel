<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\MenuRequest;
use App\Modules\Domain\Models\Menu;
use App\Modules\Domain\Services\Commands\MenuServiceCommand;
use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Menu\MenuEditForm;
use App\Modules\Presentation\Forms\Backend\Menu\MenuIndexForm;
use App\Modules\Presentation\Forms\Backend\Menu\MenuIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MenuController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $service = new MenuServiceQuery();

        return view('Backend::menu.index', [
            'form' => $this->form(MenuIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(MenuIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form(MenuEditForm::class, [
            'model' => new Menu()
        ]);

        return view('Backend::menu.edit', [
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

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(MenuEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Menu::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new MenuServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('MenuInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new MenuServiceQuery();

        if (empty($category = $service->getAllById($id))) {
            return redirect()->route('MenuIndex');
        }

        $form = $this->form(MenuEditForm::class, [
            'model' => $category
        ]);

        return view('Backend::menu.edit', [
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

        $service = new MenuServiceQuery();

        if (empty($content = $service->getById($id))) {
            return redirect()->route('MenuIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(MenuEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if ($input['alias'] != $content->alias && hasAlias(Menu::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $serviceCommand = new MenuServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('MenuEdit', $content->id);
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

        return redirect()->route('MenuIndex');
    }

    private function _update_status(Request $request) {
        $service = new MenuServiceCommand();
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

    private function _delete(Request $request) {
        $service = new MenuServiceCommand();
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
