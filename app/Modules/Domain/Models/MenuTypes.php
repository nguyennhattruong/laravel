<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MenuTypes extends Model
{
    use Sortable;

    protected $table = 'co_menu_types';

    public $sortable = ['id', 'title', 'description', 'language', 'created_at'];

    protected $attributes = [
        'title' => '',
        'description' => ''
    ];
}
