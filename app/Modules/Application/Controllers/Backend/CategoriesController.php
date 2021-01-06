<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\CategoriesRequest;
use App\Modules\Domain\Models\Categories;
use App\Modules\Domain\Services\Commands\CategoriesServiceCommand;
use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Categories\CategoriesEditForm;
use App\Modules\Presentation\Forms\Backend\Categories\CategoriesIndexForm;
use App\Modules\Presentation\Forms\Backend\Categories\CategoriesIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CategoriesController extends IController
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
        $service = new CategoriesServiceQuery();

        return view('Backend::categories.index', [
            'form' => $this->form(CategoriesIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(CategoriesIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form(CategoriesEditForm::class, [
            'model' => new Categories()
        ]);

        return view('Backend::categories.edit', [
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

        $form = $this->form(CategoriesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Categories::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new CategoriesServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('CategoriesInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new CategoriesServiceQuery();

        if (empty($category = $service->getById($id))) {
            return redirect()->route('CategoriesIndex');
        }

        $form = $this->form(CategoriesEditForm::class, [
            'model' => $category
        ]);

        return view('Backend::categories.edit', [
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

        $service = new CategoriesServiceQuery();

        if (empty($content = $service->getById($id))) {
            return redirect()->route('CategoriesIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(CategoriesEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if ($input['alias'] != $content->alias && hasAlias(Categories::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $serviceCommand = new CategoriesServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('CategoriesEdit', $content->id);
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * Trash, Restore, Update Status, delete
     *
     * @param CategoriesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('CategoriesIndex');
    }

    private function _update_status(CategoriesRequest $request) {
        $service = new CategoriesServiceCommand();
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
        $service = new CategoriesServiceCommand();
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
