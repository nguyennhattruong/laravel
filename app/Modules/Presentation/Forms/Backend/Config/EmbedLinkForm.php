<?php

namespace App\Modules\Presentation\Forms\Backend\Config;

use Kris\LaravelFormBuilder\Form;

class EmbedLinkForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('header_link', 'textarea', [
                'label' => 'Header Link'
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
