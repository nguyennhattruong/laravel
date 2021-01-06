<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Infrastructure\Core\IForm;

class CustomHTMLForm extends IForm
{
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
            ->add('title', 'text', [
                'label' => 'Tiêu đề (*)',
                'rules' => 'required'
            ])
            ->add('content', 'textarea', [
                'label' => 'Content'
            ])
            ->add('link', 'text', [
                'label' => 'Link'
            ])
            ->addStatusSimple('status')
            ->addStatusSimple('show_title', ['label' => 'Show Title'])
            ->addLayout()
            ->addLayoutPosition()
            ->addLanguage('language', [], false);
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
