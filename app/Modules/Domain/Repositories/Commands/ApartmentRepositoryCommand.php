<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Apartment;
use App\Modules\Domain\Services\Queries\ApartmentServiceQuery;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;
use App\Modules\Infrastructure\Files\Upload;
use Html2Text\Html2Text;

class ApartmentRepositoryCommand extends RepositoryCommand
{
    protected function _getData($input) {
        $isUpdate = isset($input['id']) ? true : false;
        $img_arr = [];

        if ($isUpdate) {
            $service = new ApartmentServiceQuery();
            $product = $service->getById($input['id']);

            $img_arr = $product->images == '' ? [] : explode(',', $product->images);
        } else {
            $product = new Apartment();
        }

        $product = $this->setAttributes($product, $input);

        $product->publish_up = empty($input['publish_up']) ? date('Y-m-d H:i:s')
            : date('Y-m-d H:i:s', strtotime($input['publish_up']));
        $product->status = $this->getStatus($input['status']);
        $product->language = $this->getLang('*');
        $product->price = str_replace(',', '', $product->price);

        if (is_null($input['meta_title'])) {
            $html = new Html2Text($product->title);
            $product->meta_title = $html->getText();
        }

        if (is_null($input['meta_description'])) {
            $html = new Html2Text($product->description);
            $product->meta_description = str_replace(array("\r", "\n"), " ", $html->getText());
        }

        // Images
        if (trim($input['images']) !== '') {
            $upload = new Upload(base_path(), [
                'bigDir' => config('define.folder.apartment'),
                'smallDir' => config('define.folder.apartment_thumb'),
                'smallHeight' => 500,
            ]);

            $arr = explode(',', $input['images']);
            $arr_result = [];

            if ($isUpdate) {
                foreach ($arr as $img) {
                    if (!in_array($img, $img_arr)) {
                        if (($result = $upload->uploadImage($img)) !== false) {
                            $arr_result[] = $result;
                        }
                    } else {
                        $arr_result[] = $img;
                    }
                }
            } else {
                foreach ($arr as $img) {
                    if (($result = $upload->uploadImage($img)) !== false) {
                        $arr_result[] = $result;
                    }
                }
            }

            if (!empty($arr_result)) {
                $product->images = implode(',', $arr_result);
            }
        }

        return $product;
    }

    public function insert($item) {
        $content = $this->_getData($item);
        $content->save();
        return $content->id;
    }

    public function update($item) {
        $content = $this->_getData($item);

        return $content->save();
    }

    public function delete($id) {
        return Apartment::destroy($id);
    }

    public function update_cate($id, $cate_id) {
        return Apartment::where('id', $id)->update(['category_id' => $cate_id]);
    }

    public function update_status($id, $status) {
        return Apartment::where('id', $id)->update(['status' => $status]);
    }

    public function getById($id) {
        return Apartment::find($id);
    }
}
