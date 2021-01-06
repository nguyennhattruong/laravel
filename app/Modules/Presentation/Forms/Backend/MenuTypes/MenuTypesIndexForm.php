<?php

namespace App\Modules\Presentation\Forms\Backend\MenuTypes;

use App\Modules\Infrastructure\Core\IForm;

class MenuTypesIndexForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * @author nhat_truong
     * @since  2018-06-13
     */
    private function create_element() {
        $this
            ->add('title', 'text', [
                'attr' => [
                    'placeholder' => 'Search',
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

    /**
     * @author nhat_truong
     * @since  2018-06-13
     */
    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-search"></i> Search',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
