<?php

namespace App\Modules\Presentation\Forms\Backend\Users;

use App\Modules\Infrastructure\Core\IForm;

class UsersIndexForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $this
            ->add('name', 'text', [
                'label' => 'Tên tài khoản'
            ])
            ->addDisplay('display', [
                'label' => 'Số hiển thị'
            ]);
    }

    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-search"></i> Tìm kiếm',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
