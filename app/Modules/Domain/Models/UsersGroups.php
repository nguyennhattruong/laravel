<?php

namespace App\Modules\Domain\Models;

use Baum\Node;
use Kyslik\ColumnSortable\Sortable;

class UsersGroups extends Node
{
    use Sortable;

    protected $table = 'co_users_groups';

    protected $parentColumn = 'parent_id';
    protected $leftColumn = 'lft';
    protected $rightColumn = 'rgt';
    protected $depthColumn = 'depth';
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    public $sortable = ['id', 'title'];

    protected $attributes = [
        'title' => '',
        'rules' => ''
    ];
}
