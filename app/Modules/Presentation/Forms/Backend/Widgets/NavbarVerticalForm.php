<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class NavbarVerticalForm extends IForm
{
    public $_fields = [
        'class' => '',
        'menutype_id' => ''
    ];

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
            ->addGeneralWidget()
            ->addMenuTypes('menutype_id')
            ->add('class', 'text', [
                'label' => 'Class'
            ]);
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
            ]);
    }
}
