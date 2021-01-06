<?php

namespace App\Modules\Presentation\Forms\Backend\MenuTypes;

use App\Modules\Infrastructure\Core\IForm;

class MenuTypesEditForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST'
        ];

        $this->setFormOptions($options);

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
            ->add('description', 'textarea', [
                'label' => 'Description',
                'attr' => [
                    'rows' => 5
                ]
            ])
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
