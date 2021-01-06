<?php

namespace App\Modules\Presentation\Forms\Backend\UsersGroups;

use App\Modules\Domain\Services\Queries\UsersGroupsServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class UsersGroupsEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {
        $service = new UsersGroupsServiceQuery();
        $this
            ->add('title', 'text', [
                'label' => 'Tên nhóm (*)',
                'rules' => 'required'
            ])
            ->add('parent_id', 'select', [
                'label' => 'Thuộc nhóm',
                'choices' => ['' => '- No Parent -'] + $service->getListForControl()
            ]);
    }

    private function create_button() {
        $this->addButtonSubmit();
    }
}
