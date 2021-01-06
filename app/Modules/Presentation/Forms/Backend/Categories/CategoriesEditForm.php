<?php

namespace App\Modules\Presentation\Forms\Backend\Categories;

use App\Modules\Infrastructure\Core\IForm;

class CategoriesEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * Create Elements
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_element() {
        $this
            ->add('title', 'text', [
                'label' => 'Title (*)',
                'rules' => 'required'
            ])
            ->add('alias', 'text', [
                'label' => 'Alias',
                'attr' => [
                    'placeholder' => 'Auto-generate from title'
                ]
            ])
            ->add('description', 'textarea', [
                'label' => 'Description',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addParentCates('parent_id', ['label' => 'Parent ID'], true, @$this->model->id)
            ->addCategoryStatus('status', 'select', false)
            ->addLanguage('language', [], false);
    }

    /**
     * Create Buttons
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-floppy-o"></i> Save',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->add('clear', 'reset', [
                'label' => '<i class="fa fa-undo"></i> Reset',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
