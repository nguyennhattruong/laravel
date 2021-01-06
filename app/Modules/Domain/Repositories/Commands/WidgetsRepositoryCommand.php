<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Widgets;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;

class WidgetsRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    public function insert($input) {
        $widget = new Widgets();

        $widget->title = $input['description'];
        $widget->widget = $input['widget'];
        $widget->position = $input['position'];
        $widget->params = $input['params'];
        $widget->layout = 'default';

        if ($widget->save()) {
            return $widget->id;
        }

        return false;
    }

    /**
     * @param $input [ordering => id] - [0 => 9, 1 => 10]
     * @return bool
     */
    public function updateOrdering($input) {
        $error = [];

        foreach ($input as $key => $value) {
            if (!empty($value)) {
                $widget = Widgets::find($value);
                $widget->ordering = $key;

                if (!$widget->save()) {
                    $error[] = $value;
                }
            }
        }

        return count($error) == 0;
    }

    public function update($input) {
        $widget = Widgets::find($input->input('id'));

        $widget->title = $input->input('title') ?: '';
        $widget->link = $input->input('link') ?: '';
        $widget->content = $input->input('content') ?: '';
        $widget->layout = $input->input('layout') ?: '';
        $widget->position = $input->input('position') ?: '';
        $widget->status = $input->input('status');
        $widget->show_title = $input->input('show_title');
        $widget->language = $input->input('language') ?: '';
        $widget->params = $input->input('params') ?: '';
        $widget->options = sprintf('{"session":{"class":"%s","attr":"%s"},"header":{"class":"%s","attr":"%s"},"body":{"class":"%s","attr":"%s"}}',
            $input->input('section_class') ?: '',
             addslashes($input->input('section_attr')) ?: '',
            $input->input('header_class') ?: '',
            addslashes($input->input('header_attr')) ?: '',
            $input->input('body_class') ?: '',
            addslashes($input->input('body_attr')) ?: ''
        );

        return $widget->save();
    }

    public function delete($id) {
        return Widgets::destroy($id);
    }
}
