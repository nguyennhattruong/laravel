<?php

namespace App\Modules\Presentation\Forms\Backend\Content;

use App\Modules\Infrastructure\Core\IForm;

class ContentEditForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
        ];

        $this->setFormOptions($options);

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
                'label' => 'Title (*)',
                'rules' => 'required'
            ])
            ->add('alias', 'text', [
                'label' => 'Alias',
                'attr' => [
                    'placeholder' => 'Auto-generate from title'
                ]
            ])
            ->add('introtext', 'textarea', [
                'label' => 'Description',
                'attr' => [
                    'rows' => 5
                ]
            ])
            ->add('fulltext', 'textarea', [
                'label' => 'Content'
            ])
            ->add('layout_type', 'select', [
                'label' => 'Layout',
                'choices' => [
                    '1' => 'Mặc định',
                    '2' => 'Trang',
                ]
            ])
            ->add('layout', 'textarea', [
                'label' => 'Giao diện',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addCategories('category_id', [], false)
            ->addContentStatus('status', 'select', false, false)
            ->addLanguage('language', [], false)
            ->add('author', 'text', [
                'label' => 'Author'
            ])
            ->add('source', 'text', [
                'label' => 'Source'
            ])
            ->add('publish_up', 'datetimepicker', [
                'label' => 'Start Publishing'
            ])
            ->add('publish_down', 'datetimepicker', [
                'label' => 'Finish Publishing'
            ]);
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
            ])
            ->add('clear', 'reset', [
                'label' => '<i class="fa fa-undo"></i> Reset',
                'attr' => [
                    'class' => 'btn btn-secondary'
                ]
            ]);
    }
}
