<?php

namespace App\Modules\Presentation\Forms\Backend\Content;

use App\Modules\Infrastructure\Core\IForm;

class ContentIndexForm extends IForm
{
    public function buildForm() {
        $this
            ->addText('title', [
                'attr' => [
                    'placeholder' => 'Search...'
                ]
            ])
            ->addCategories('category_id')
            ->addLanguage('language')
            ->addDisplay('display')
            ->addButtonSearch()
            ->addContentStatus('status', 'radio');
    }
}
