<?php

namespace App\Modules\Presentation\Forms\Backend\Config;

use Kris\LaravelFormBuilder\Form;

class MetadataForm extends Form
{
    const INDEX_FOLLOW     = 0;
    const NOINDEX_FOLLOW   = 1;
    const INDEX_NOFOLLOW   = 2;
    const NOINDEX_NOFOLLOW = 3;

    public function buildForm()
    {
        $this
            ->add('meta_keywords', 'textarea', [
                'label' => 'meta_keywords',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('meta_robots', 'select', [
                'label' => 'meta_robots',
                'choices' => [
                    self::INDEX_FOLLOW => 'Index, Follow',
                    self::NOINDEX_FOLLOW => 'No index, follow',
                    self::INDEX_NOFOLLOW => 'Index, No follow',
                    self::NOINDEX_NOFOLLOW => 'No index, No follow',
                ]
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
