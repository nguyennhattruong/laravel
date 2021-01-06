<?php

namespace App\Modules\Domain\Models;

use Baum\Extensions\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use Sortable;

    protected $table = 'co_contact';

    protected $attributes = [
        'title' => '',
        'content' => '',
        'fullname' => '',
        'email' => '',
        'mobile' => '',
        'phone' => '',
        'address' => '',
        'ip' => '',
        'send_time' => '',
        'type' => 1,
        'read' => 1
    ];

    public $timestamps = false;
}
