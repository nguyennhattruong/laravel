<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Bill_details extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'co_bill_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'address', 'phone_number', 'note'
//    ];

}
