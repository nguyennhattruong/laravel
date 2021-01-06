<?php

namespace App\Modules\Presentation\Forms\Backend\MenuTypes;

use App\Modules\Infrastructure\Core\IForm;

class MenuTypesIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('MenuTypesManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        $this->addButtonDelete();
    }
}
