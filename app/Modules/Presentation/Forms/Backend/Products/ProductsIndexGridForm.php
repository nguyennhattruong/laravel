<?php

namespace App\Modules\Presentation\Forms\Backend\Products;

use App\Modules\Infrastructure\Core\IForm;

class ProductsIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('ProductsManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        $this
            ->add('update_status', 'button', [
                'label' => 'Update <i class="fa fa-long-arrow-right"></i>',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'name' => 'update_status',
                    'data-coco' => 'manage',
                    'data-coco-value' => 'update_status',
                    'value' => 1
                ]
            ])
            ->addButtonDelete()
            ->addContentStatus('status_to', 'select', false, false);
    }
}
