<?php

namespace App\Modules\Presentation\Forms\Backend\Menu;

use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class MenuEditForm extends IForm
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
        $service = new MenuServiceQuery();
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
            ->add('description', 'textarea', [
                'label' => 'Description',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->addMenuTypes('menutype_id', [
                'rules' => 'required'
            ], false)
            ->add('onsite', 'select', [
                'label' => 'Link Type',
                'choices' => [
                    '1' => 'Liên kết trong',
                    '2' => 'Liên kết ngoài'
                ]
            ])
            ->add('link_options', 'select', [
                'label' => 'Chức năng',
                'choices' => [
                    'home' => 'Trang chủ',
                    'content' => 'Bài viết',
                    'categories' => 'Nhóm bài viết',
                    'products_categories' => 'Loại sản phẩm',
                    'contact' => 'Liên hệ',
//                    'page' => 'Trang',
                    'neo' => 'Liên kết Neo #',
                ]
            ])
            ->add('id_link', 'text', [
                'label' => 'ID'
            ])
            ->add('icon', 'text', [
                'label' => 'Icon'
            ])
            ->add('link', 'text', [
                'label' => 'URL'
            ])
            ->add('target', 'select', [
                'label' => 'Target',
                'choices' => [
                    '_parent' => '_parent',
                    '_blank' => '_blank',
                    '_self' => '_self',
                    '_top' => '_top',
                ]
            ])
            ->addParentMenu('parent_id', ['label' => 'Parent ID'], true, @$this->model->id)
            ->addCategoryStatus('status', 'select', false)
            ->addLanguage('language', [], false)
            ->add('ordering', 'select', [
                'label_show' => false,
                'choices' => $service->getSiblings(@$this->model->id)
            ])
            ->add('ordering_options', 'radiogroupsimple', [
                'label' => 'Vị trí phía',
                'elements' => [
                    [
                        'label' => 'Trước',
                        'value' => 'previous'
                    ],
                    [
                        'label' => 'Sau',
                        'value' => 'next'
                    ],
                ],
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
