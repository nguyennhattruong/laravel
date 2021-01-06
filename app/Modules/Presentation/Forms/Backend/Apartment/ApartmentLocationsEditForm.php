<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Infrastructure\Core\IForm;

class ApartmentLocationsEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this
            ->add('name', 'text', [
                'label' => 'Tên dự án (*)',
                'rules' => 'required'
            ])
            ->add('alias', 'text', [
                'label' => 'Alias',
                'attr' => [
                    'placeholder' => 'Tự tạo alias nếu để trống'
                ]
            ])
            ->add('content', 'textarea', [
                'label' => 'Nội dung',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('description', 'textarea', [
                'label' => 'Tóm tắt',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addStatusSimple()
            ->addLanguage('language', [], false);
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
