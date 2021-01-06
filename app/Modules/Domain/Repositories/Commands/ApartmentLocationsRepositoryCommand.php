<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\ApartmentLocations;
use App\Modules\Domain\Repositories\Queries\ApartmentLocationsRepositoryQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;
use App\Modules\Infrastructure\Files\Upload;

class ApartmentLocationsRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    protected function _getData($input, $type = 'insert') {
        switch ($type) {
            case 'insert':
                $page = new ApartmentLocations();
                break;
            case 'update':
                $service = new ApartmentLocationsRepositoryQuery();
                $page = $service->getById($input['id']);
                break;
            default:
                return null;
        }

        $page = $this->setAttributes($page, $input);
        $page->status = $this->getStatus($input['status']);
        $page->language = $this->getLang('*');

        if (trim($input['image']) !== '') {
            $upload = new Upload(base_path(), [
                'bigDir' => config('define.folder.apartment_locations'),
                'smallDir' => config('define.folder.apartment_locations_thumb')
            ]);

            if (($result = $upload->uploadImage($input['image'])) !== false) {
                $page->image = $result;
            }
        }

        return $page;
    }

    public function insert($item) {
        $pages = $this->_getData($item);
        return $pages->save();
    }

    public function update($item) {
        $pages = $this->_getData($item, 'update');
        return $pages->save();
    }

    public function delete($id) {
        return ApartmentLocations::destroy($id);
    }
}
