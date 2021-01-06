<?php

namespace App\Modules\Presentation\Forms\Backend\Pages;

use App\Modules\Infrastructure\Core\IForm;

class PagesEditForm extends IForm
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
            ->add('layout', 'textarea', [
                'label' => 'Layout',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('content', 'textarea', [
                'label' => 'Content',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('description', 'textarea', [
                'label' => 'Tóm tắt'
            ])
            ->addStatusSimple()
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
