<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property  title
 */
class Content extends Model
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_TRASH = 2;

    protected $table = 'co_content';

    public $sortable = ['id', 'title', 'author', 'language', 'created_at', 'hits', 'status'];

    protected $attributes = [
        'title' => '',
        'alias' => '',
        'category_id' => 0,
        'image' => '',
        'image_alt' => '',
        'layout_type' => 1,
        'layout' => '',
        'introtext' => '',
        'fulltext' => '',
        'created_by' => 0,
        'modified_by' => 0,
        'author' => '',
        'meta' => '',
        'publish_up' => '',
        'publish_down' => '',
        'status' => 1,
        'rating_sum' => 0,
        'rating_count' => 0,
        'params' => '',
        'hits' => 0,
        'source' => '',
        'ordering' => 0,
        'language' => '*',
        'attribs' => ''
    ];

    public function category() {
        return $this->hasOne('App\Modules\Domain\Models\Categories', 'id', 'category_id');
    }
}
