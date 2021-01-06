<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\ProductsCategories;
use App\Modules\Domain\Services\Commands\ProductsCategoriesServiceCommand;
use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\ProductsCategories\ProductsCategoriesEditForm;
use App\Modules\Presentation\Forms\Backend\ProductsCategories\ProductsCategoriesIndexForm;
use App\Modules\Presentation\Forms\Backend\ProductsCategories\ProductsCategoriesIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ProductsCategoriesController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();

        $this->_serviceQuery = new ProductsCategoriesServiceQuery();
        $this->_serviceCommand = new ProductsCategoriesServiceCommand();
        $this->_model = new ProductsCategories();
    }

    protected function init() {
        $this->_formEdit       = ProductsCategoriesEditForm::class;
        $this->_formIndex      = ProductsCategoriesIndexForm::class;
        $this->_formIndexGrid  = ProductsCategoriesIndexGridForm::class;
        $this->_viewIndex      = 'Backend::products_categories.index';
        $this->_viewEdit       = 'Backend::products_categories.edit';
        $this->_serviceQuery   = NULL;
        $this->_serviceCommand = NULL;
        $this->_model          = NULL;
        $this->_routeInsert    = 'ProductsCategoriesInsert';
        $this->_routeEdit      = 'ProductsCategoriesEdit';
        $this->_routeIndex     = 'ProductsCategoriesIndex';
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        return view($this->_viewIndex, [
            'form' => $this->form($this->_formIndex, ['model' => $request]),
            'formGrid' => $this->form($this->_formIndexGrid, ['model' => $request]),
            'data' => $this->_serviceQuery->getList($request)
        ]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $form = $this->form($this->_formEdit, [
            'model' => $this->_model
        ]);

        return view($this->_viewEdit, [
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

        $form = $this->form($this->_formEdit, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias($this->_model, $input['alias'])) {
            return $this->errorAlias($input);
        }

        if ($this->_serviceCommand->insert($input)) {
            return $this->successSave($this->_routeInsert);
        } else {
            return $this->errorSave($input);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id) {
        if (empty($category = $this->_serviceQuery->getById($id))) {
            return redirect()->route($this->_routeIndex);
        }

        $form = $this->form($this->_formEdit, [
            'model' => $category
        ]);

        return view($this->_viewEdit, [
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

        if (empty($content = $this->_serviceQuery->getById($id))) {
            return redirect()->route($this->_routeIndex);
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form($this->_formEdit, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if ($input['alias'] != $content->alias && hasAlias($this->_model, $input['alias'])) {
            return $this->errorAlias($input);
        }

        if ($this->_serviceCommand->update($input)) {
            return $this->successSave($this->_routeEdit, $content->id);
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

        return redirect()->route($this->_routeIndex);
    }

    private function _update_status(Request $request) {
        $errors = [];

        if (empty($request->input('id'))) {
            return $this->warningCheckAll();
        }

        foreach ($request->input('id') as $id) {
            if (!$this->_serviceCommand->update_status($id, $request->input('status_to'))) {
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
