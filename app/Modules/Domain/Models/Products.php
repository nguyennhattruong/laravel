<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property  title
 */
class Products extends Model
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_products';

    public $sortable = ['id', 'title', 'language', 'created_at', 'hits', 'status'];

    protected $attributes = [
        'title' => '',
        'alias' => '',
        'content' => '',
        'description' => '',
        'price' => 0,
        'price_contact' => 0,
        'price_compare' => 0,
        'vat' => 1,
        'sku' => '',
        'barcode' => '',
        'inventory' => 0,
        'quantity' => 1,
        'inventory_policy' => 0,
        'meta_title' => '',
        'meta_keywords' => '',
        'meta_description' => '',
        'images' => '',
        'status' => 1,
        'publish_up' => '',
        'category_id' => 0,
        'vendor_id' => 0,
        'language' => '*',
        'hits' => 0
    ];

    public function category() {
//        return $this->hasOne('App\Modules\Domain\Models\Categories', 'id', 'category_id');
    }
}
