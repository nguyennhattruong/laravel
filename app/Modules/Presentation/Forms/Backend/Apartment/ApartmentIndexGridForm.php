<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Infrastructure\Core\IForm;

class ApartmentIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('ApartmentManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        $this->addButtonDelete();
    }
}
