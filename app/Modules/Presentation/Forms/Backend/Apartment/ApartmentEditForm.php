<?php

namespace App\Modules\Presentation\Forms\Backend\Apartment;

use App\Modules\Domain\Models\ApartmentUtilities;
use App\Modules\Domain\Repositories\Queries\ApartmentTypesRepositoryQuery;
use App\Modules\Domain\Repositories\Queries\AttributesValuesRepositoryQuery;
use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class ApartmentEditForm extends IForm
{
    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    /**
     * Create Elements
     */
    private function create_element() {
        if (isset($this->model->id)) {
            $this->model->features = ApartmentUtilities::where('apartment_id', $this->model->id)
                ->get()->pluck('attribute_id')->toArray();
        }

        $typeRepo = new ApartmentTypesRepositoryQuery();
        $locationService = new ApartmentLocationsServiceQuery();

        $featureRepo = new AttributesValuesRepositoryQuery();
        $featureResult = $featureRepo->getListByAttributeId();
        $features = [];
        foreach ($featureResult as $type) {
            $features[$type->id] = $type->name;
        }

        $labels = [
            [
                'label' => 'Mới',
                'value' => 1
            ],
            [
                'label' => 'Nổi bật',
                'value' => 2
            ],
        ];

        $state = [
            [
                'label' => 'Chuyển nhượng',
                'value' => 1
            ],
            [
                'label' => 'Cho thuê',
                'value' => 2
            ],
            [
                'label' => 'Đã giao dịch',
                'value' => 3
            ],
        ];

        $types = [];
        $typesResult = $typeRepo->finAll();
        foreach ($typesResult as $type) {
            $types[] = [
                'label' => $type->name,
                'value' => $type->id,
            ];
        }

        $locations = ['' => '- - Chọn dự án - -']
            + $locationService->getAll()->pluck('name', 'id')->toArray();

        $this
            ->add('name', 'text', [
                'label' => 'Tên căn hộ',
                'rules' => 'required'
            ])
            ->add('alias', 'text', [
                'label' => 'Alias',
                'attr' => [
                    'placeholder' => 'Tự tạo alias nếu để trống'
                ]
            ])
            ->add('content', 'textarea', [
                'label' => 'Nội dung',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('description', 'textarea', [
                'label' => 'Mô tả ngắn',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('features', 'select', [
                'label' => 'Tiện ích',
                'choices' => $features,
                'attr' => [
                    'class' => 'form-control selectpicker',
                    'data-style' => 'btn btn-outline-secondary',
                    'data-none-selected-text' => '',
                    'multiple' => '',
                    'title' => '- - Chọn tiện ích - -',
                    'name' => 'features[]'
                ]
            ])
            ->addStatusSimple('status', [
                'label_show' => false
            ])
            ->add('label_id', 'radiogroupsimple', [
                'label' => 'Labels',
                'elements' => $labels
            ])
            ->add('state', 'radiogroupsimple', [
                'label' => 'Tình trạng',
                'elements' => $state
            ])
            ->add('type_id', 'radiogroupsimple', [
                'label' => 'Loại căn hộ',
                'elements' => $types
            ])
            ->add('location_id', 'select', [
                'label' => 'Dự án',
                'choices' => $locations
            ])
            ->add('price', 'text', [
                'label' => 'Giá',
                'attr' => [
                    'data-coco' => 'autonumeric'
                ],
                'rules' => 'max:20',
            ])
            ->add('code', 'text', [
                'label' => 'Mã căn hộ'
            ])
            ->add('bedroom', 'number', [
                'label' => 'Phòng ngủ'
            ])
            ->add('bathroom', 'number', [
                'label' => 'Phòng tắm'
            ])
            ->add('land_size', 'number', [
                'label' => 'Diện tích'
            ])
            ->add('year_built', 'number', [
                'label' => 'Năm'
            ])
            ->add('meta_title', 'text', [
                'label' => 'Thẻ tiêu đề'
            ])
            ->add('meta_description', 'textarea', [
                'label' => 'Thẻ mô tả',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('publish_up', 'datetimepicker', [
                'label' => 'Thời gian hiển thị'
            ])
            ->addLanguage('language', [], false);
    }

    /**
     * Create Buttons
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
