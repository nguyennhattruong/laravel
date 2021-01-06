<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Services\Queries\PagesServiceQuery;
use App\Modules\Infrastructure\Core\IController;

class PagesController extends IController
{
    public function show($alias)
    {
        $service = new PagesServiceQuery();
        $data = $service->getByAlias($alias);

        $layout = [
            'header_left' => '',
            'header_right' => '',
        ];
        if (!empty($data->layout)) {
            $json = json_decode($data->layout);

            foreach ($layout as $key => $value) {
                if (isset($json->$key) && $json->$key != '') {
                    $layout[$key] = explode(',', $json->$key);
                }
            }
        }

        return iView('pages', [
            'data' => $data,
            'layout' => $layout
        ]);
    }
}
