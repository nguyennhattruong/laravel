<?php

namespace App\Modules\Application\Controllers\Backend;

use App\Modules\Domain\Services\Commands\WidgetsServiceCommand;
use App\Modules\Domain\Services\Queries\WidgetsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use App\Modules\Presentation\Forms\Backend\Widgets\ApartmentListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\ApartmentLocationListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\CarouselBootstrapForm;
use App\Modules\Presentation\Forms\Backend\Widgets\CategoriesListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\ContentListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\ContentRelatedListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\CustomHTMLForm;
use App\Modules\Presentation\Forms\Backend\Widgets\NavbarForm;
use App\Modules\Presentation\Forms\Backend\Widgets\NavbarVerticalForm;
use App\Modules\Presentation\Forms\Backend\Widgets\ProductsCategoriesListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\ProductsListForm;
use App\Modules\Presentation\Forms\Backend\Widgets\SearchForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class WidgetsController extends IController
{
    use FormBuilderTrait;

    public function index() {
        $service = new WidgetsServiceQuery();
        $positions = getWidgetPosition();
        $data = [];

        foreach ($positions as $key => $value) {
            $data['position'][$key] = $widgets = $service->getListByPosition($key);
        }

        $data['widgets'] = config('define.widgets');

        return view('Backend::widget.index', [
            'data' => $data
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $service = new WidgetsServiceQuery();
        $info = $service->getByIdForEdit($id)->toArray();
        $layout = '';

        if (!empty($info)) {
            $layout = $info['widget'];
        }

        $class = $this->_getFields($layout);

        // Generate params
        $objClass = new $class();

        if (!empty($objClass->_fields)) {
            foreach ($objClass->_fields as $field => $value) {
                if (isset($info['params']->$field)) {
                    $info[$field] = $info['params']->$field;
                }
            }
        }

        $form = $this->form($class, [
            'model' => $info,
        ]);

        $blade = 'general_widget';
        if ($layout == 'custom_html') {
            $blade = 'custom_html';
        }

        return view('Backend::widget.' . $blade, [
            'form' => $form,
            'data' => $info,
        ]);
    }

    public function update(Request $request, $id) {
        $input = $request;

        $serviceQuery = new WidgetsServiceQuery();
        $info = $serviceQuery->getById($id);

        if (empty($info)) {
            return $this->errorSave($input);
        }

        $class = $this->_getFields($info->widget);

        // Validation Form
        $form = $this->form($class, ['model' => $input]);
        if (!$form->isValid()) {
            return $this->errorForm($form, $input);
        }

        // params
        $objClass = new $class();

        if (!empty($objClass->_fields)) {
            $arrParams = [];

            foreach ($objClass->_fields as $field => $value) {
                $arrParams[$field] = $input->input($field);
            }

            $input->merge([
                'params' => json_encode($arrParams)
            ]);
        }

        $service = new WidgetsServiceCommand();
        $input->merge([
            'id' => $id,
        ]);

        if ($service->update($input)) {
            return $this->successSave('WidgetsEdit', $id);
        };

        return $this->errorSave($input);
    }

    private function _getFields($layout) {
        $class = '';
        switch ($layout) {
            case 'custom_html':
                $class = CustomHTMLForm::class;
                break;
            case 'search':
                $class = SearchForm::class;
                break;
            case 'content_list':
                $class = ContentListForm::class;
                break;
            case 'apartment_list':
                $class = ApartmentListForm::class;
                break;
            case 'apartment_location_list':
                $class = ApartmentLocationListForm::class;
                break;
            case 'categories_list':
                $class = CategoriesListForm::class;
                break;
            case 'content_related_list':
                $class = ContentRelatedListForm::class;
                break;
            case 'products_list':
                $class = ProductsListForm::class;
                break;
            case 'products_categories_list':
                $class = ProductsCategoriesListForm::class;
                break;
            case 'carousel_bootstrap':
                $class = CarouselBootstrapForm::class;
                break;
            case 'navbar':
                $class = NavbarForm::class;
                break;
            case 'navbar_vertical':
                $class = NavbarVerticalForm::class;
                break;
            default:
                break;
        }

        return $class;
    }
}
