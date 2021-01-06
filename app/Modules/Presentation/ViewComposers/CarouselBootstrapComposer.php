<?php

namespace App\Modules\Presentation\ViewComposers;

use Illuminate\View\View;

class CarouselBootstrapComposer
{
    public function compose(View $view) {
        $data = $view->offsetGet('wid_content');

        $result = [];
        $images = [];
        $links = [];

        if (isset($data['params']->images)) {
            $images = explode(PHP_EOL, $data['params']->images);
        }

        if (isset($data['params']->links)) {
            $links = explode(PHP_EOL, $data['params']->links);
        }

        foreach ($images as $key => $value) {
            $result[] = [
                'image' => $value,
                'link' => isset($links[$key]) ? $links[$key] : ''
            ];
        }

        $view->with('data', $result);
    }
}
