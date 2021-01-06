<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class CarouselBootstrapForm extends IForm
{
    public $_fields = [
        'images' => '',
        'links' => '',
        'controls' => 1,
        'indicators' => 1,
//        'captions' => 1,
        'crossfade' => 0,
        'class' => ''
    ];

    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * Create Elements
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_element() {
        $this
            ->addGeneralWidget()
            ->add('class', 'text', [
                'label' => 'Class'
            ])
            ->add('images', 'textarea', [
                'label' => 'Hình ảnh',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('links', 'textarea', [
                'label' => 'Liên kết',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addStatusSimple('controls', ['label' => 'Show controls'])
            ->addStatusSimple('indicators', ['label' => 'Show indicators'])
            ->addStatusSimple('crossfade', ['label' => 'Crossfade'])
        ;
    }

    /**
     * Create Buttons
     *
     * @author nhat_truong
     * @since  2017-12-18
     */
    private function create_button() {
        $this
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-floppy-o"></i> Save',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}
