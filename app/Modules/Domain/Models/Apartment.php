<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Apartment extends Model
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    const STATE = [
        1 => 'Chuyển nhượng',
        2 => 'Cho thuê',
        3 => 'Đã giao dịch'
    ];

    const LABEL = [
        1 => 'Mới',
        2 => 'Nổi bật'
    ];

    protected $table = 'co_apartment';

    public $sortable = ['id', 'name', 'language', 'created_at', 'hits', 'status'];

    protected $attributes = [
        'name' => '',
        'alias' => '',
        'content' => '',
        'description' => '',
        'feature_id' => 0,
        'status' => 1,
        'state' => 1,
        'label_id' => 0,
        'type_id' => 0,
        'location_id' => 0,
        'images' => '',
        'price' => 0,
        'code' => '',
        'bedroom' => 0,
        'bathroom' => 0,
        'land_size' => 0,
        'year_built' => 0,
        'meta_title' => '',
        'meta_keywords' => '',
        'meta_description' => '',
        'publish_up' => '',
        'language' => '*',
        'hits' => 0
    ];

    public function type() {
        return $this->hasOne('App\Modules\Domain\Models\ApartmentTypes', 'id', 'type_id');
    }
}
