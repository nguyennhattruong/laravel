<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentUtilities extends Model
{
    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'co_apartment_utilities';

    protected $attributes = [
        'apartment_id' => '',
        'attribute_id' => ''
    ];
}
