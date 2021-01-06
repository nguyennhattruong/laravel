<?php

namespace App\Modules\Presentation\Forms\Backend\Widgets;

use App\Modules\Domain\Repositories\Queries\ApartmentTypesRepositoryQuery;
use App\Modules\Domain\Services\Queries\ApartmentLocationsServiceQuery;
use App\Modules\Infrastructure\Core\IForm;

class ApartmentLocationListForm extends IForm
{
    public $_fields = [
        'quantity' => 5,
        'columns' => 3
    ];

    public function buildForm() {
        $this->create_element();
        $this->create_button();
    }

    private function create_element() {

        $this
            ->addGeneralWidget()
            ->add('quantity', 'number', [
                'label' => 'Quantity'
            ])
            ->add('columns', 'number', [
                'label' => 'Columns'
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
