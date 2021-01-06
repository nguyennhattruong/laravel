<?php

namespace App\Modules\Presentation\Forms\Backend\Categories;

use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\IForm;
use Illuminate\Support\Facades\Input;

class CategoriesIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('CategoriesManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        if (Input::get('status') == Content::STATUS_TRASH) {
            $this->addButtonRestore()
                 ->add('delete', 'submit', [
                     'label' => '<i class="fa fa-times"></i> Delete',
                     'attr' => [
                         'class' => 'btn btn-danger',
                         'name' => 'delete',
                         'data-toggle' => 'modal',
                         'data-target' => '#exampleModal',
                         'value' => 1
                     ]
                 ]);
        } else {
            // Update status
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
}
