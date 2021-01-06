<?php

//namespace App\Http\Controllers\Admin;
namespace App\Modules\Application\Controllers\Backend;
use App\Modules\Domain\Models\Bills;
use App\Modules\Domain\Models\Customers;
use Illuminate\Http\Request;
use Session;

use App\Modules\Infrastructure\Core\IController;


class BillController extends IController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = new Customers();

        $this->data['customers'] =  $customers->getAll();
        return view('Backend::bill.index', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = new Customers();
        $bill = new Bills();
        $customerInfo = $customers->get_customer_by_id($id);
        $billInfo = $bill->get_bill_by_customer_id($id);

        $this->data['customerInfo'] = $customerInfo;
        $this->data['billInfo'] = $billInfo;

        return view('Backend::bill.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = new Bills();
        $bill->update_status($id, $request->input('status'));
        Session::flash('message', "Successfully updated");

        return redirect('admin/bill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $bill = new Bills();
        $bill->delete_bill($id);
        Session::flash('message', "Successfully deleted");

        return redirect('admin/bill');
    }
}
