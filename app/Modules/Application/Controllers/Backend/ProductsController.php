<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Application\Requests\CategoriesRequest;
use App\Modules\Domain\Models\Products;
use App\Modules\Domain\Repositories\Commands\ProductsRepositoryCommand;
use App\Modules\Domain\Services\Commands\ProductsServiceCommand;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Products\ProductsEditForm;
use App\Modules\Presentation\Forms\Backend\Products\ProductsIndexForm;
use App\Modules\Presentation\Forms\Backend\Products\ProductsIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ProductsController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $service = new ProductsServiceQuery();

        return view('Backend::products.index', [
            'form' => $this->form(ProductsIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(ProductsIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    public function create() {
        return view('Backend::products.edit', [
            'form' => $this->form(ProductsEditForm::class, [
                'model' => new Products()
            ])
        ]);
    }

    public function store(Request $request) {
        $input = $request->input();

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(ProductsEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Products::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new ProductsRepositoryCommand();

        if ($service->insert($input)) {
            return $this->successSave('ProductsInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    public function edit($id) {
        $service = new ProductsServiceQuery();

        if (empty($category = $service->getById($id))) {
            return redirect()->route('CategoriesIndex');
        }

        return view('Backend::products.edit', [
            'form' => $this->form(ProductsEditForm::class, ['model' => $category])
        ]);
    }

    public function update(Request $request, $id) {
        $input = $request->input();
        $input['vat'] = isset($input['vat']) ? : 0;
        $input['inventory_policy'] = isset($input['inventory_policy']) ? : 0;
        $input['id'] = $id;

        $serviceQuery = new ProductsServiceQuery();

        //<editor-fold desc="Validation">
        if (empty($product = $serviceQuery->getById($id))) {
            return redirect()->route('ProductsIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['title']);
        }

        $form = $this->form(ProductsEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        if ($input['alias'] != $product->alias && hasAlias(Products::class, $input['alias'])) {
            return $this->errorAlias($input);
        }
        //</editor-fold>

        $serviceCommand = new ProductsServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('ProductsEdit', $product->id);
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

        return redirect()->route('ProductsIndex');
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
        $service = new ProductsServiceCommand();
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
