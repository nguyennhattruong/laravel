<?php

namespace App\Modules\Presentation\Forms\Backend\Config;

use App\Modules\Infrastructure\Core\IForm;

class GeneralForm extends IForm
{
    public function buildForm() {
        $this->languageName = 'config';
        $this
            ->addText('site_name', [
                'rules' => 'required|max:80'
            ])
            ->addTextarea('meta_description')
            ->addYesNoSimple('off')
            ->addTextarea('off_message')
            ->addButtonSubmit();
    }
}
