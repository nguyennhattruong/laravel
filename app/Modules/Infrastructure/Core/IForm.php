<?php

namespace App\Modules\Infrastructure\Core;

use App\Modules\Domain\Models\Content;
use App\Modules\Domain\Services\Queries\CategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\MenuServiceQuery;
use App\Modules\Domain\Services\Queries\MenuTypesServiceQuery;
use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use Kris\LaravelFormBuilder\Form;

class IForm extends Form
{
    const PAGING = 10;

    public function addText($name, $options = []) {
        $defaults = [
            'label' => trans("Backend::{$this->languageName}.{$name}")
        ];
        $opts = array_merge($defaults, $options);
        return $this->add($name, 'text', $opts);
    }

    public function addNumber($name, $options = []) {
        $defaults = [
            'label' => trans("Backend::{$this->languageName}.{$name}")
        ];
        $opts = array_merge($defaults, $options);
        return $this->add($name, 'number', $opts);
    }

    public function addPassword($name, $options = []) {
        $defaults = [
            'label' => trans("Backend::{$this->languageName}.{$name}")
        ];
        $opts = array_merge($defaults, $options);
        return $this->add($name, 'password', $opts);
    }

    public function addTextarea($name, $options = []) {
        $defaults = [
            'label' => trans("Backend::{$this->languageName}.{$name}"),
            'attr' => [
                'rows' => 3
            ]
        ];
        $opts = array_merge($defaults, $options);
        return $this->add($name, 'textarea', $opts);
    }

    public function addSelect($name, $choices = [], $options = []) {
        $defaults = [
            'label' => trans("Backend::{$this->languageName}.{$name}"),
            'choices' => $choices
        ];
        $opts = array_merge($defaults, $options);
        return $this->add($name, 'select', $opts);
    }

    /**
     * Create categories list
     *
     * @param string $name
     * @param array $options
     * @param bool $hasDefault
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-01-16
     */
    public function addCategories($name = 'category_id', $options = [], $hasDefault = true) {
        $cateServiceQuery = new CategoriesServiceQuery();
        $defaults = [
            'label' => 'Category',
            'choices' => $cateServiceQuery->getListForControl(),
        ];

        $options = array_merge($defaults, $options);

        if ($hasDefault) {
            $options['empty_value'] = '- ' . trans('Backend::common.select_empty_categories') . ' -';
        }

        return $this->add($name, 'select', $options);
    }

    public function addProductsCategories($name = 'category_id', $options = [], $hasDefault = true) {
        $service = new ProductsCategoriesServiceQuery();
        $defaults = [
            'label' => 'Category',
            'choices' => $service->getListForControl(),
        ];

        $options = array_merge($defaults, $options);

        if ($hasDefault) {
            $options['empty_value'] = '- ' . trans('Backend::common.select_empty_categories') . ' -';
        }

        return $this->add($name, 'select', $options);
    }

    /**
     * Menu Types DropDownList
     *
     * @param string $name
     * @param array $options
     * @param bool $hasDefault
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-06-13
     */
    public function addMenuTypes($name = 'menutype_id', $options = [], $hasDefault = true) {
        $service = new MenuTypesServiceQuery();
        $defaults = [
            'label' => 'Menu Types',
            'choices' => $service->getAllForControl(),
        ];

        $options = array_merge($defaults, $options);

        if ($hasDefault) {
            $options['empty_value'] = '- Nhóm menu -';
        }

        return $this->add($name, 'select', $options);
    }

    /**
     * @param string $name
     * @param array $options
     * @param bool $hasDefault
     * @param $current_id
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-03-23
     */
    public function addParentCates($name = 'parent_id', $options = [], $hasDefault = true, $current_id) {
        $cateServiceQuery = new CategoriesServiceQuery();
        $default = [];

        if ($hasDefault) {
            $default = ['' => '- No Parent -'];
        }

        $defaults = [
            'label' => 'Parent ID',
            'choices' => $default + $cateServiceQuery->getListForControl($current_id)
        ];

        $options = array_merge($defaults, $options);

        return $this->add($name, 'select', $options);
    }

    public function addParentProductCates($name = 'parent_id', $options = [], $hasDefault = true, $current_id) {
        $cateServiceQuery = new ProductsCategoriesServiceQuery();
        $default = [];

        if ($hasDefault) {
            $default = ['' => '- No Parent -'];
        }

        $defaults = [
            'label' => 'Parent ID',
            'choices' => $default + $cateServiceQuery->getListForControl($current_id)
        ];

        $options = array_merge($defaults, $options);

        return $this->add($name, 'select', $options);
    }

    public function addParentMenu($name = 'parent_id', $options = [], $hasDefault = true, $current_id = null) {
        $cateServiceQuery = new MenuServiceQuery();
        $default = [];

        if ($hasDefault) {
            $default = ['' => '- No Parent -'];
        }

        $defaults = [
            'label' => 'Parent ID',
            'choices' => $default + $cateServiceQuery->getListParents($current_id)
        ];

        $options = array_merge($defaults, $options);

        return $this->add($name, 'select', $options);
    }

    /**
     * Status for Content
     *
     * @param string $name
     * @param string $type
     * @param bool $hasDefault
     * @param bool $hasTrash
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-01-16
     */
    public function addContentStatus($name = 'content_status', $type = 'select', $hasDefault = true, $hasTrash = true) {
        if ($type == 'select') {
            $options = [
                'label' => 'Status',
                'choices' => [
                    Content::STATUS_PUBLISHED => 'Published',
                    Content::STATUS_UNPUBLISHED => 'Unpublished'
                ]
            ];

            if ($hasDefault) {
                $options['empty_value'] = '- All -';
            }

            if ($hasTrash) {
                $options['choices'] += [Content::STATUS_TRASH => 'Trashed'];
            }

            return $this->add($name, 'select', $options);
        } elseif ($type == 'radio') {
            $elements = [];

            if ($hasDefault) {
                $elements[] = ['label' => trans('Backend::common.status_all'), 'value' => NULL];
            }

            $elements[] = ['label' => trans('Backend::common.status_published'), 'value' => Content::STATUS_PUBLISHED];
            $elements[] = ['label' => trans('Backend::common.status_unpublished'), 'value' => Content::STATUS_UNPUBLISHED];

            if ($hasTrash) {
                $elements[] = ['label' => trans('Backend::common.status_trashed'), 'value' => Content::STATUS_TRASH];
            }

            return $this->add('status', 'radiogroup', [
                'label' => 'Status',
                'elements' => $elements,
                'attr' => [
                    'class' => 'btn btn-outline-secondary'
                ]
            ]);
        }

        return NULL;
    }

    /**
     * @param string $name
     * @param string $type
     * @param bool $hasDefault
     * @return IForm
     *
     * @author nhat_truong
     * @since  2018-03-23
     */
    public function addCategoryStatus($name = 'content_status', $type = 'select', $hasDefault = true) {
        if ($type == 'select') {
            $options = [
                'label' => 'Status',
                'choices' => [
                    Content::STATUS_PUBLISHED => 'Published',
                    Content::STATUS_UNPUBLISHED => 'Unpublished'
                ]
            ];

            if ($hasDefault) {
                $options['empty_value'] = '- All -';
            }

            return $this->add($name, 'select', $options);
        } elseif ($type == 'radio') {
            $elements = [];

            if ($hasDefault) {
                $elements[] = ['label' => 'All', 'value' => NULL];
            }

            $elements[] = ['label' => 'Published', 'value' => Content::STATUS_PUBLISHED];
            $elements[] = ['label' => 'Unpublished', 'value' => Content::STATUS_UNPUBLISHED];

            return $this->add('status', 'radiogroup', [
                'label' => 'Status',
                'elements' => $elements,
                'attr' => [
                    'class' => 'btn btn-outline-secondary'
                ]
            ]);
        }

        return NULL;
    }

    /**
     * @param string $name
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-01-16
     */
    public function addStatus($name = 'status') {
        return
            $this->add($name, 'radiogroup', [
                'label' => 'Status',
                'elements' => [
                    [
                        'label' => 'Yes',
                        'attr' => [
                            'class' => 'btn btn-success'
                        ],
                        'value' => 1
                    ],
                    [
                        'label' => 'No',
                        'attr' => [
                            'class' => 'btn btn-success'
                        ],
                        'value' => 0
                    ],
                ],
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function addStatusSimple($name = 'status', $options = []) {
        $options_default = [
            'label' => 'Status',
            'elements' => [
                [
                    'label' => 'Hiển thị',
                    'value' => 1
                ],
                [
                    'label' => 'Ẩn',
                    'value' => 0
                ],
            ]
        ];

        return
            $this->add($name, 'radiogroupsimple', array_merge($options_default, $options));
    }

    public function addYesNoSimple($name = 'status', $options = []) {
        $options_default = [
            'label' => trans('Backend::common.label_status'),
            'elements' => [
                [
                    'label' => trans('Backend::common.label_yes'),
                    'value' => 1
                ],
                [
                    'label' => trans('Backend::common.label_no'),
                    'value' => 0
                ],
            ]
        ];

        return
            $this->add($name, 'radiogroupsimple', array_merge($options_default, $options));
    }

    public function addButtonSearch() {
        return $this->add('submit', 'submit', [
            'label' => '<i class="fa fa-search"></i> ' . trans('Backend::common.btn_search'),
            'attr' => [
                'class' => 'btn btn-secondary'
            ]
        ]);
    }

    public function addButtonSubmit() {
        return $this->add('submit', 'submit', [
            'label' => '<i class="fa fa-floppy-o"></i> ' . trans('Backend::common.btn_save'),
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    public function addButtonReset() {
        return $this->add('clear', 'reset', [
            'label' => '<i class="fa fa-undo"></i> ' . trans('Backend::common.btn_reset'),
            'attr' => [
                'class' => 'btn btn-secondary'
            ]
        ]);
    }

    /**
     * Button Trash
     *
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-03-15
     */
    public function addButtonTrash() {
        return
            $this
                ->add('trash', 'button', [
                    'label' => '<i class="fa fa-trash-o"></i> Trash',
                    'attr' => [
                        'class' => 'btn btn-danger',
                        'name' => 'trash',
                        'data-coco' => 'manage',
                        'data-coco-value' => 'trash'
                    ]
                ]);
    }

    /**
     * Button Delete
     *
     * @return $this
     */
    public function addButtonDelete() {
        return
            $this
                ->add('delete', 'button', [
                    'label' => '<i class="fa fa-trash-o"></i> Xóa',
                    'attr' => [
                        'class' => 'btn btn-danger',
                        'name' => 'delete',
                        'data-coco' => 'manage',
                        'data-coco-value' => 'delete'
                    ]
                ]);
    }

    /**
     * Button restore
     *
     * @return $this
     * @author nhat_truong
     * @since  2018-03-19
     */
    public function addButtonRestore() {
        return
            $this
                ->add('restore', 'submit', [
                    'label' => '<i class="fa fa-refresh"></i> Restore',
                    'attr' => [
                        'class' => 'btn btn-success',
                        'data-coco' => 'manage',
                        'data-coco-value' => 'trash',
                    ]
                ]);
    }

    /**
     * @param string $name
     * @param array $options
     * @param bool $hasDefault
     * @return $this
     *
     * @author nhat_truong
     * @since  2018-03-20
     */
    public function addLanguage($name = 'language', $options = [], $hasDefault = true) {
        $options += [
            'label' => 'Language',
            'choices' => [
                '*' => 'All',
                'vi' => 'Vietnamese',
                'en' => 'English'
            ]
        ];

        if ($hasDefault) {
            $options['empty_value'] = '- ' . trans('Backend::common.select_empty_language') . ' -';
        }

        return $this->add($name, 'select', $options);
    }

    public function addDisplay($name = 'display', $options = []) {
        $defaults = [
            'label' => 'Hiển thị',
            'choices' => [
                '5' => '5',
                '10' => '10',
                '15' => '15',
                '20' => '20',
                '25' => '25',
                '30' => '30',
                '50' => '50',
                '100' => '100',
                '200' => '200',
                '500' => '500',
                '-1' => 'All'
            ],
            'attr' => [
                'class' => 'form-control',
                'onchange' => 'this.form.submit()'
            ],
            'selected' => function ($data) {
                return empty($data) ? self::PAGING : $data;
            }
        ];

        return $this->add($name, 'select', array_merge($defaults, $options));
    }

    public function addSex($name = 'sex') {
        $options = [
            'label' => 'Giới tính',
            'choices' => [
                '' => '- Giới tính -',
                '0' => 'Nam',
                '1' => 'Nữ',
            ],
            'attr' => [
                'class' => 'form-control'
            ]
        ];

        return $this->add($name, 'select', $options);
    }

    public function addLayout($name = 'layout') {
        $options = [
            'label' => 'Layout',
            'choices' => config('define.layouts')
        ];

        return $this->add($name, 'select', $options);
    }

    public function addLayoutPosition($name = 'position') {
        $positions = getWidgetPosition();

        $options = [
            'label' => 'Position',
            'choices' => $positions
        ];

        return $this->add($name, 'select', $options);
    }

    public function addGeneralWidget() {
        return
            $this
                ->add('title', 'text', [
                    'label' => 'Tiêu đề (*)',
                    'rules' => 'required'
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
}
