<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    protected $table = 'co_widgets';

    protected $attributes = [
        'title' => '',
        'content' => '',
        'link' => '',
        'status' => 1,
        'layout' => '',
        'position' => '',
        'ordering' => 0,
        'widget' => '',
        'access' => '',
        'params' => '',
        'options' => '',
        'language' => '*',
    ];
}
