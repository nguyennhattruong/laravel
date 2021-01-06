<?php

namespace App\Modules\Presentation\Forms\Backend\ProductsCategories;

use App\Modules\Infrastructure\Core\IForm;

class ProductsCategoriesIndexForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this->addText('title')
             ->addLanguage('language')
             ->addDisplay('display');
    }

    private function create_button() {
        $this->addButtonSearch()
             ->addCategoryStatus('status', 'radio');
    }
}
