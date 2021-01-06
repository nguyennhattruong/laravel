<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Domain\Repositories\Queries\ApartmentTypesRepositoryQuery;
use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class ApartmentListForm extends IForm
{
    public $_fields = [
        'type_id' => '',
        'location_id' => '',
        'quantity' => 5,
        'columns' => 3,
        'template' => 1
    ];

    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {

        $typeRepo = new ApartmentTypesRepositoryQuery();
        $locationService = new ApartmentLocationsServiceQuery();

        $types = ['' => '- - Chọn loại căn hộ - -']
            + $typeRepo->finAll()->pluck('name', 'id')->toArray();

        $layouts = [
            '1' => 'Layout 1',
            '2' => 'Layout 2'
        ];

        $locations = [
                '' => '- - Chọn loại dự án - -',
                'current' => '- - Dự án đang xem - -'
            ] + $locationService->getAll()->pluck('name', 'id')->toArray();

        $this
            ->addGeneralWidget()
            ->add('type_id', 'select', [
                'label' => 'Loại căn hộ',
                'choices' => $types
            ])
            ->add('location_id', 'select', [
                'label' => 'Dự án',
                'choices' => $locations
            ])
            ->add('quantity', 'number', [
                'label' => 'Quantity'
            ])
            ->add('columns', 'number', [
                'label' => 'Columns'
            ])
            ->add('template', 'select', [
                'label' => 'Giao diện',
                'choices' => $layouts
            ]);
    }

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
