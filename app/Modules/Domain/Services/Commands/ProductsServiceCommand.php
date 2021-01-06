<?php

namespace App\Modules\Domain\Services\Commands;

use App\Modules\Domain\Repositories\Commands\ProductsRepositoryCommand;
use App\Modules\Infrastructure\Core\Domain\ServiceCommand;
use Illuminate\Support\Facades\Storage;

class ProductsServiceCommand extends ServiceCommand
{
    private $_rep;

    function __construct() {
        $this->_rep = new ProductsRepositoryCommand();
    }

    public function insert($content) {
        return $this->_rep->insert($content);
    }

    public function update($content) {
        return $this->_rep->update($content);
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
                    @unlink(getBaseImage($img, 'define.folder.products'));
                    @unlink(getBaseImage($img, 'define.folder.products_thumb'));
                }
            }
        }
        return true;
    }

    public function deleteImage($product_id, $name) {
        if (!empty($info = $this->_rep->getById($product_id))) {
            if (!empty($images = explode(',', $info->images))) {
                if (in_array($name, $images)) {
                    @unlink(getBaseImage($name, 'define.folder.products'));
                    @unlink(getBaseImage($name, 'define.folder.products_thumb'));

                    $images = array_diff($images, [$name]);
                    $info->images = implode(',', $images);
                    $info->save();
                }
            }
        }

        return true;
    }
}
