<?php

namespace App\Modules\Presentation\Forms\Backend\Users;

use App\Modules\Domain\Services\Queries\UsersGroupsServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class UsersEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $service = new UsersGroupsServiceQuery();
        $this
            ->add('password', 'password', [
                'label' => 'Mật khẩu'
            ])
            ->add('name', 'text', [
                'label' => 'Tài khoản',
                'rules' => 'required|string|max:100'
            ])
            ->addText('fullname', [
                'label' => 'Họ tên'
            ])
            ->addSelect('group_id', $service->getListForControl(), [
                'label' => 'Nhóm thành viên',
            ])
            ->add('remark', 'textarea', [
                'label' => 'Ghi chú',
                'attr' => [
                    'rows' => 2
                ]
            ]);
    }

    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-floppy-o"></i> Lưu',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}
