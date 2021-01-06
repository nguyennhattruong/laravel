<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\Apartment;
use App\Modules\Domain\Services\Commands\ApartmentServiceCommand;
use App\Modules\Domain\Services\Queries\ApartmentServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentEditForm;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentIndexForm;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ApartmentController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $service = new ApartmentServiceQuery();

        return view('Backend::apartment.index', [
            'form' => $this->form(ApartmentIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(ApartmentIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    public function create() {
        return view('Backend::apartment.edit', [
            'form' => $this->form(ApartmentEditForm::class, [
                'model' => new Apartment()
            ])
        ]);
    }

    public function store(Request $request) {
        $input = $request->input();

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['name']);
        }

        $form = $this->form(ApartmentEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(Apartment::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new ApartmentServiceCommand();

        if ($service->insert($input)) {
            return $this->successSave('ApartmentInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    public function edit($id) {
        $service = new ApartmentServiceQuery();

        if (empty($category = $service->getById($id))) {
            return redirect()->route('ApartmentIndex');
        }

        return view('Backend::apartment.edit', [
            'form' => $this->form(ApartmentEditForm::class, ['model' => $category])
        ]);
    }

    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $serviceQuery = new ApartmentServiceQuery();

        //<editor-fold desc="Validation">
        if (empty($product = $serviceQuery->getById($id))) {
            return redirect()->route('ApartmentIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['name']);
        }

        $form = $this->form(ApartmentEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        if ($input['alias'] != $product->alias && hasAlias(Apartment::class, $input['alias'])) {
            return $this->errorAlias($input);
        }
        //</editor-fold>

        $serviceCommand = new ApartmentServiceCommand();

        if ($serviceCommand->update($input)) {
            return $this->successSave('ApartmentEdit', $product->id);
        } else {
            return $this->errorSave($input);
        }
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

        return redirect()->route('ApartmentIndex');
    }

    private function _delete(Request $request) {
        $service = new ApartmentServiceCommand();
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
