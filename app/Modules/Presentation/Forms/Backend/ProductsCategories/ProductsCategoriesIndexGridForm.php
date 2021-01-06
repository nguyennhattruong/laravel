<?php

namespace App\Modules\Presentation\Forms\Backend\ProductsCategories;

use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\IForm;
use Illuminate\Support\Facades\Input;

class ProductsCategoriesIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('ProductsCategoriesManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        if (Input::get('status') == Content::STATUS_TRASH) {
            $this->addButtonDelete();
        } else {
            $this->addCategoryStatus('status_to', 'select', false)
                 ->addButtonDelete();
        }
    }
}
