<?php

namespace App\Modules\Presentation\Forms\Backend\Config;

use Kris\LaravelFormBuilder\Form;

class EmbedCssForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('header_css', 'textarea', [
                'label' => 'CSS'
            ])
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-floppy-o"></i> Save',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->add('clear', 'reset', [
                'label' => '<i class="fa fa-undo"></i> Reset',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
