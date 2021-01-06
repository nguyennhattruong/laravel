<?php

namespace App\Modules\Presentation\Forms\Backend\Content;

use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\IForm;
use Illuminate\Support\Facades\Input;

class ContentIndexGridForm extends IForm
{
    public function buildForm() {
        $options = [
            'method' => 'POST',
            'url' => route('ContentManage'),
            'id' => 'form_list'
        ];

        $this->setFormOptions($options);

        $this->create_button();
    }

    private function create_button() {
        if (Input::get('status') == Content::STATUS_TRASH) {
            $this->addButtonRestore()
                 ->addButtonDelete();
        } else {
            // Update cate
            $this
                ->add('update_cate', 'submit', [
                    'label' => 'Update <i class="fa fa-long-arrow-right"></i>',
                    'attr' => [
                        'class' => 'btn btn-primary',
                        'data-coco' => 'manage',
                        'data-coco-value' => 'trash',
                    ]
                ])
                ->addCategories('cate', [], false);

            // Update status
            $this
                ->add('update_status', 'submit', [
                    'label' => 'Update <i class="fa fa-long-arrow-right"></i>',
                    'attr' => [
                        'class' => 'btn btn-primary',
                        'data-coco' => 'manage',
                        'data-coco-value' => 'trash',
                    ]
                ])
                ->addContentStatus('status_to', 'select', false, false);

            $this->addButtonTrash();
        }
    }
}
