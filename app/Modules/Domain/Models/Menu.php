<?php

namespace App\Modules\Domain\Models;

use Baum\Node;
use Kyslik\ColumnSortable\Sortable;

class Menu extends Node
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_menu';

    protected $parentColumn = 'parent_id';
    protected $leftColumn = 'lft';
    protected $rightColumn = 'rgt';
    protected $depthColumn = 'depth';
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    public $sortable = ['id', 'title', 'language', 'created_at', 'status'];

    protected $attributes = [
        'title' => '',
        'alias' => '',
        'description' => '',
        'menutype_id' => 0,
        'onsite' => 1,
        'parent_id' => NULL,
        'lft' => 0,
        'rgt' => 0,
        'depth' => 0,
        'icon' => '',
        'link' => '',
        'target' => '',
        'home' => 0,
        'status' => 1,
        'language' => ''
    ];

    public function category() {
        return $this->hasOne('App\Modules\Domain\Models\Menu', 'id', 'parent_id');
    }
}
