<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property  title
 */
class Pages extends Model
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_pages';

    public $sortable = ['id', 'title', 'language', 'created_at', 'status'];

    protected $attributes = [
        'title' => '',
        'alias' => '',
        'layout' => '',
        'description' => '',
        'content' => '',
        'status' => 1,
        'attribs' => '',
        'language' => '',
    ];
}
