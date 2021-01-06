<?php

namespace App\Modules\Presentation\Forms\Backend\Users;

use App\Modules\Infrastructure\Core\IForm;

class UsersIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('UsersManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);
        $this->create_button();
    }

    private function create_button() {
        $this->addButtonDelete();
    }
}
