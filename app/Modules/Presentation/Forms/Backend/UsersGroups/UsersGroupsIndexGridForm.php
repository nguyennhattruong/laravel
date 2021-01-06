<?php

namespace App\Modules\Presentation\Forms\Backend\UsersGroups;

use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\IForm;
use Illuminate\Support\Facades\Input;

class UsersGroupsIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('UsersGroupsManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);
        $this->create_button();
    }

    private function create_button() {
        $this->addButtonDelete();
    }
}
