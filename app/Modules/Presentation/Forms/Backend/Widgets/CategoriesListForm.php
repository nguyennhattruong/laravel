<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class CategoriesListForm extends IForm
{
    public $_fields = [
        'category_id' => ''
    ];

    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this->addGeneralWidget()
             ->addText('category_id', [
                 'label' => 'Thể loại'
             ]);
    }

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
