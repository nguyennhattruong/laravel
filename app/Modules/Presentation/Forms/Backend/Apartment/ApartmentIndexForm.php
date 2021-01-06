<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Infrastructure\Core\IForm;

class ApartmentIndexForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * Create Elements
     *
     * @author nhat_truong
     * @since  2018-01-04
     */
    private function create_element() {
        $this
            ->add('name', 'text', [
                'attr' => [
                    'placeholder' => 'Tên căn hộ',
                    'class' => 'form-control'
                ]
            ])
//            ->addCategories('category_id', [
//                'attr' => [
//                    'class' => 'form-control'
//                ]
//            ])
            ->addLanguage('language', [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->addDisplay('display');
    }

    /**
     * @author nhat_truong
     * @since  2018-01-08
     */
    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-search"></i> Search',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
//            ->addCategoryStatus('status', 'radio');
    }
}
