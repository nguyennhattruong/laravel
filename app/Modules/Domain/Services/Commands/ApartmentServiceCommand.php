<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Models\ApartmentUtilities;
use App\Modules\Domain\Repositories\Commands\ApartmentRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;

class ApartmentServiceCommand extends ServiceCommand
{
    private $_rep;

    function __construct() {
        $this->_rep = new ApartmentRepositoryCommand();
    }

    public function insert($content) {
        if ($id = $this->_rep->insert($content)) {
            $this->addAttr($id, $content);
        }
        return true;
    }

    public function update($content) {
        if ($this->_rep->update($content)) {
            $this->addAttr($content['id'], $content);
        }
        return true;
    }

    private function addAttr($id, $content) {
        // Delete old data
        ApartmentUtilities::where('apartment_id', $id)->delete();
        // Add new data
        if (!empty($content['features'])) {
            $data = [];
            foreach ($content['features'] as $item) {
                $data[] = [
                    'apartment_id' => $id,
                    'attribute_id' => $item,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            ApartmentUtilities::insert($data);
        }
    }

    public function delete($id) {
        $this->deleteImageById($id);
        return $this->_rep->delete($id);
    }

    public function update_cate($id, $cate_id) {
        return $this->_rep->update_cate($id, $cate_id);
    }

    public function update_status($id, $cate_id) {
        return $this->_rep->update_status($id, $cate_id);
    }

    /**
     * Delete all images from id
     *
     * @param $id
     * @return bool
     */
    public function deleteImageById($id) {
        if (!empty($info = $this->_rep->getById($id))) {
            if (!empty($images = explode(',', $info->images))) {
                foreach ($images as $img) {
                    @unlink(getBaseImage($img, 'define.folder.apartment'));
                    @unlink(getBaseImage($img, 'define.folder.apartment_thumb'));
                }
            }
        }
        return true;
    }

    public function deleteImage($product_id, $name) {
        if (!empty($info = $this->_rep->getById($product_id))) {
            if (!empty($images = explode(',', $info->images))) {
                if (in_array($name, $images)) {
                    @unlink(getBaseImage($name, 'define.folder.apartment'));
                    @unlink(getBaseImage($name, 'define.folder.apartment_thumb'));

                    $images = array_diff($images, [$name]);
                    $info->images = implode(',', $images);
                    $info->save();
                }
            }
        }

        return true;
    }
}
