<?php

namespace App\Modules\Presentation\Forms\Backend\ProductsCategories;

use App\Modules\Infrastructure\Core\IForm;

class ProductsCategoriesEditForm extends IForm
{
    public function buildForm() {
        $this->languageName = 'products_categories';
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this
            ->addText('title', [
                'rules' => 'required'
            ])
            ->addText('alias', [
                'attr' => [
                    'placeholder' => 'Auto-generate from title'
                ]
            ])
            ->addTextarea('description', [
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addParentProductCates('parent_id', ['label' => 'Parent ID'], true, @$this->model->id)
            ->addCategoryStatus('status', 'select', false)
            ->addLanguage('language', [], false);
    }

    private function create_button() {
        $this->addButtonSubmit()
             ->addButtonReset();
    }
}
