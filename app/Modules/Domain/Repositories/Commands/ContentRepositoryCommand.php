<?php

namespace App\Modules\Domain\Repositories\Commands;

use App\Modules\Domain\Models\Content;
use App\Modules\Infrastructure\Core\Domain\RepositoryCommand;
use App\Modules\Domain\Services\Queries\ContentServiceQuery;
use App\Modules\Infrastructure\Files\Upload;
use Illuminate\Support\Facades\Storage;

class ContentRepositoryCommand extends RepositoryCommand
{
    function __construct() {
    }

    /**
     * Create object for insert, update
     *
     * @param $input
     * @param string $type
     * @return Content|\App\Modules\Infrastructure\Core\Domain\Model
     *
     * @author nhat_truong
     * @since  2018-03-15
     */
    protected function _getData($input, $type = 'insert') {
        $current_date = date('Y-m-d H:i:s');

        switch ($type) {
            case 'insert':
                $content = new Content();
                break;
            case 'update':
                $service = new ContentServiceQuery();
                $content = $service->getById($input['id']);
                break;
            default:
                return NULL;
        }

        $content = $this->setAttributes($content, $input);
        $content->publish_up = empty($input['publish_up']) ? $current_date : date('Y-m-d H:i:s', strtotime($input['publish_up']));
        $content->publish_down = empty($input['publish_down']) ? $current_date : date('Y-m-d H:i:s', strtotime($input['publish_down']));

        if ($content->publish_down < $content->publish_up) {
            $content->publish_down = $content->publish_up;
        }

        if ($type == 'update') {
            // Delete old image
            if ($content->getOriginal()['image'] != $input['image']) {
                @unlink(getBaseImage($content->image, 'define.folder.content'));
                @unlink(getBaseThumbImage($content->image, 'define.folder.content_thumb'));
                $content->image = '';
            }
        }

        $content->category_id = is_null($input['category_id']) ? 1 : $input['category_id'];
        $content->status = $this->getStatus($input['status']);
        $content->language = $this->getLang($input['language']);

        if (trim($input['image']) !== '') {
            $upload = new Upload(base_path(), [
                'bigDir' => config('define.folder.content'),
                'smallDir' => config('define.folder.content_thumb')
            ]);

            if (($result = $upload->uploadImage($input['image'])) !== false) {
                $content->image = $result;
            }
        }

        // Attributes
        $attrs = [];
        foreach ($input['attr_key'] as $key => $value) {
            if (!is_null($value)) {
                $attrs[$value] = $input['attr_value'][$key];
            }
        }

        $content->attribs = '';
        if (!empty($attrs)) {
            $content->attribs = json_encode($attrs);
        }

        return $content;
    }

    /**
     * @param $item
     * @return mixed
     * @author nhat_truong
     * @since  2018-03-08
     */
    public function insert($item) {
        $content = $this->_getData($item);
        return $content->save();
    }

    /**
     * @param $item
     * @return mixed
     * @author nhat_truong
     * @since  2018-03-08
     */
    public function update($item) {
        $content = $this->_getData($item, 'update');
        return $content->save();
    }

    public function delete($id) {
        return Content::destroy($id);
    }

    public function trash($id) {
        return Content::where('id', $id)->update(['status' => Content::STATUS_TRASH]);
    }

    public function restore($id) {
        return Content::where('id', $id)->update(['status' => Content::STATUS_PUBLISHED]);
    }

    public function update_cate($id, $cate_id) {
        return Content::where('id', $id)->update(['category_id' => $cate_id]);
    }

    public function update_status($id, $status) {
        return Content::where('id', $id)->update(['status' => $status]);
    }
}
