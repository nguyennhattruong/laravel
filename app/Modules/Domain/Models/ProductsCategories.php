<?php

namespace App\Modules\Domain\Models;

use Baum\Node;
use Kyslik\ColumnSortable\Sortable;

class ProductsCategories extends Node
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED   = 1;

    protected $table = 'co_products_categories';

    protected $parentColumn = 'parent_id';
    protected $leftColumn = 'lft';
    protected $rightColumn = 'rgt';
    protected $depthColumn = 'depth';
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    public $sortable = ['id', 'title', 'author', 'language', 'created_at', 'status'];

    protected $attributes = [
        'title' => '',
        'description' => '',
        'status' => 1,
        'ordering' => 0
    ];

    public function category() {
        return $this->hasOne('App\Modules\Domain\Models\ProductsCategories', 'id', 'parent_id');
    }
}
