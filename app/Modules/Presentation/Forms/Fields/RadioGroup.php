<?php namespace App\Modules\Presentation\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class RadioGroup extends FormField
{
    protected function getTemplate()
    {
        return 'Fields::radio_group';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        return parent::render($options, $showLabel, $showField, $showError);
    }
}
