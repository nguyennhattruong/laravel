<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_attributes';

    protected $attributes = [
        'name' => '',
        'column_name' => '',
        'note' => '',
        'status' => 1,
        'sequence' => 0
    ];
}
