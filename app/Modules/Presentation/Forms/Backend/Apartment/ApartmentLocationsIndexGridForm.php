<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Infrastructure\Core\IForm;

class ApartmentLocationsIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('ApartmentLocationsManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);
        $this->create_button();
    }

    private function create_button() {
        $this
            ->addButtonDelete();
    }
}
