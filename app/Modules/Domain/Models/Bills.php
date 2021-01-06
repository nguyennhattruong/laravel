<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Bills extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'co_bills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'address', 'phone_number', 'note'
//    ];


    function get_bill_by_customer_id($cus_id)
    {
        return Bills::join('co_bill_details', 'co_bills.id', '=', 'co_bill_details.bill_id')
            ->leftjoin('co_products', 'co_bill_details.product_id', '=', 'co_products.id')
            ->where('co_bills.customer_id', '=', $cus_id)
            ->where('co_bills.disable', '=', 0)
            ->select('co_bills.*', 'co_bill_details.*', 'co_products.title as product_name')
            ->get();
    }

    function update_status($id, $status)
    {
        Bills::where('id', $id)->update(['status' => $status]);
    }

    function delete_bill($id)
    {
        Bills::where('id', $id)->update(['disable' => 1]);
    }
}
