<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ApartmentTypes extends Model
{
    use Sortable;

    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_apartment_types';

    public $sortable = ['id', 'name', 'language', 'created_at', 'status'];

    protected $attributes = [
        'name' => '',
        'alias' => '',
        'status' => 1,
        'language' => '*'
    ];
}
