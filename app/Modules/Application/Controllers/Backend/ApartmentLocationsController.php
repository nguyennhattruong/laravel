<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Models\ApartmentLocations;
use App\Modules\Domain\Services\Commands\ApartmentLocationsServiceCommand;
use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentLocationsEditForm;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentLocationsIndexForm;
use App\Modules\Presentation\Forms\Backend\Apartment\ApartmentLocationsIndexGridForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ApartmentLocationsController extends IController
{
    use FormBuilderTrait;

    function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $service = new ApartmentLocationsServiceQuery();

        return view('Backend::apartment_locations.index', [
            'form' => $this->form(ApartmentLocationsIndexForm::class, ['model' => $request]),
            'formGrid' => $this->form(ApartmentLocationsIndexGridForm::class, ['model' => $request]),
            'data' => $service->getList($request)
        ]);
    }

    public function create() {
        return view('Backend::apartment_locations.edit', [
            'form' => $this->form(ApartmentLocationsEditForm::class, [
                'model' => new ApartmentLocations()
            ]),
            'image' => ''
        ]);
    }

    public function store(Request $request) {
        $input = $request->input();

        if (trim($input['alias']) == '') {
            $input['alias'] = str_slug($request['name']);
        }

        $form = $this->form(ApartmentLocationsEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // Check alias
        if (hasAlias(ApartmentLocations::class, $input['alias'])) {
            return $this->errorAlias($input);
        }

        $service = new ApartmentLocationsServiceCommand();

        $input['content'] = json_encode($request->only([
            'overviewImage',
            'overviewContent',
            'positionImage',
            'positionContent',
            'utilityImage',
            'utilityShow',
            'oneImage',
            'oneContent',
            'oneShow',
            'twoImage',
            'twoContent',
            'twoShow',
            'threeImage',
            'threeContent',
            'threeShow',
            'officeImage',
            'officeContent',
            'officeShow'
        ]));

        if ($service->insert($input)) {
            return $this->successSave('ApartmentLocationsInsert');
        } else {
            return $this->errorSave($input);
        }
    }

    public function edit($id) {
        $service = new ApartmentLocationsServiceQuery();

        if (empty($category = $service->getById($id))) {
            return redirect()->route('ApartmentLocationsIndex');
        }

        $content = json_decode($category->content);
        foreach ($content as $key => $value) {
            $category->$key = $value;
        }

        return view('Backend::apartment_locations.edit', [
            'form' => $this->form(ApartmentLocationsEditForm::class, ['model' => $category]),
            'image' => $category->image
        ]);
    }

    public function update(Request $request, $id) {
        $input = $request->input();
        $input['id'] = $id;

        $serviceQuery = new ApartmentLocationsServiceQuery();

        //<editor-fold desc="Validation">
        if (empty($product = $serviceQuery->getById($id))) {
            return redirect()->route('ApartmentLocationsIndex');
        }

        if (empty($input['alias'])) {
            $input['alias'] = str_slug($request['name']);
        }

        $form = $this->form(ApartmentLocationsEditForm::class, ['model' => $input]);

        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        if ($input['alias'] != $product->alias && hasAlias(ApartmentLocations::class, $input['alias'])) {
            return $this->errorAlias($input);
        }
        //</editor-fold>

        $serviceCommand = new ApartmentLocationsServiceCommand();

        $input['content'] = json_encode($request->only([
            'overviewImage',
            'overviewContent',
            'positionImage',
            'positionContent',
            'utilityImage',
            'utilityShow',
            'oneImage',
            'oneContent',
            'oneShow',
            'twoImage',
            'twoContent',
            'twoShow',
            'threeImage',
            'threeContent',
            'threeShow',
            'officeImage',
            'officeContent',
            'officeShow'
        ]));

        if ($serviceCommand->update($input)) {
            return $this->successSave('ApartmentLocationsEdit', $product->id);
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

        return redirect()->route('ApartmentLocationsIndex');
    }

    private function _delete(Request $request) {
        $service = new ApartmentLocationsServiceCommand();
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
