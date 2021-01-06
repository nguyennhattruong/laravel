<?php

namespace App\Modules\Presentation\Forms\Backend\Pages;

use App\Modules\Infrastructure\Core\IForm;

class PagesIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('PagesManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);
        $this->create_button();
    }

    private function create_button() {
        $this
            ->add('update_status', 'submit', [
                'label' => 'Update <i class="fa fa-long-arrow-right"></i>',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'name' => 'update_status',
                    'data-toggle' => 'modal',
                    'data-target' => '#exampleModal',
                    'value' => 1
                ]
            ])
            ->addCategoryStatus('status_to', 'select', false)
            ->addButtonDelete();
    }
}
