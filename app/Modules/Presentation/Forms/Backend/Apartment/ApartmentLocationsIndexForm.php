<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Infrastructure\Core\IForm;

class ApartmentLocationsIndexForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this
            ->add('name', 'text', [
                'attr' => [
                    'placeholder' => 'Tìm kiếm',
                    'class' => 'form-control'
                ]
            ])
            ->addLanguage('language', [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->addDisplay('display');
    }

    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-search"></i> Search',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ])
            ->addCategoryStatus('status', 'radio');
    }
}
