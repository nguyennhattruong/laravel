<?php

namespace App\Modules\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Customers extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'co_customers';

    public function getAll() {
        return Customers::join('co_bills', 'co_customers.id', '=', 'co_bills.customer_id')
            ->select('co_customers.*', 'co_bills.status', 'co_bills.id as bill_id')
            ->where('co_bills.disable', '=', 0)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function get_customer_by_id($id) {
        return Customers::join('co_bills', 'co_customers.id', '=', 'co_bills.customer_id')
            ->select('co_customers.*', 'co_bills.id as bill_id', 'co_bills.total as bill_total', 'co_bills.note as bill_note', 'co_bills.status')
            ->where('co_customers.id', '=', $id)
            ->where('co_bills.disable', '=', 0)
            ->first();
    }

}
