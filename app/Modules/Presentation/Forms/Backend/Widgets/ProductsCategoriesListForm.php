<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class ProductsCategoriesListForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this->addGeneralWidget();
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
