<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'co_config';

    protected $attributes = [
        'off' => 1,
        'smtp_auth' => 1
    ];

    public $timestamps = false;
}
