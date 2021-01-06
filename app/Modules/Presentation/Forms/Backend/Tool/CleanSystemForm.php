<?php

namespace App\Modules\Presentation\Forms\Backend\Tool;

use Kris\LaravelFormBuilder\Form;

class CleanSystemForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Clean',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }
}
