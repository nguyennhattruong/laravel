<?php

namespace App\Modules\Domain\Models;

use Baum\Node;
use Kyslik\ColumnSortable\Sortable;

class Categories extends Node
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_categories';

    protected $parentColumn = 'parent_id';
    protected $leftColumn = 'lft';
    protected $rightColumn = 'rgt';
    protected $depthColumn = 'depth';
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    public $sortable = ['id', 'title', 'author', 'language', 'created_at', 'hits', 'status'];

    protected $attributes = [
        'title' => '',
        'description' => '',
        'status' => 1,
        'ordering' => 0
    ];

    public function category() {
        return $this->hasOne('App\Modules\Domain\Models\Categories', 'id', 'parent_id');
    }
}
