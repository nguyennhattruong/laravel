<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class ContentRelatedListForm extends IForm
{
    public $_fields = [
        'quantity' => 5,
        'columns' => 1,
        'template' => '1',
        'showImage' => 1,
        'showTitle' => 1,
        'showIntro' => 1,
        'subIntro' => 150,
        'slider' => 0
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
            // Custom
            ->add('template', 'select', [
                'label' => 'Giao diện',
                'choices' => [
                    '1' => 'Hàng ngang',
                    '2' => 'Hàng dọc',
                    '3' => 'Hàng dọc (Thuộc tính)',
                ]
            ])
            ->add('quantity', 'number', [
                'label' => 'Quantity'
            ])
            ->add('columns', 'number', [
                'label' => 'Columns'
            ])
            ->addStatusSimple('showImage', ['label' => 'Show Image'])
            ->addStatusSimple('showTitle', ['label' => 'Show Title'])
            ->addStatusSimple('slider', ['label' => 'Slider'])
            ->addStatusSimple('showIntro', ['label' => 'Show Intro'])
            ->add('subIntro', 'number', [
                'label' => 'Số từ hiển thị (Tóm tắt)',
                'value' => function ($data) {
                    return $data ? : 200;
                }
            ])
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
