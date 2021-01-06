@extends('Backend::layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Chi tiết đơn hàng
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                        <div>
                            <h4></h4>
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Thông tin khách hàng</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Thông tin người đặt hàng</td>
                                    <td>{{ $customerInfo->name }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày đặt hàng</td>
                                    <td>{{ $customerInfo->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{ $customerInfo->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>{{ $customerInfo->address }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $customerInfo->email }}</td>
                                </tr>
                                <tr>
                                    <td>Ghi chú</td>
                                    <td>{{ $customerInfo->bill_note }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-hover  table-bordered" role="grid" >
                            <thead class="thead-dark">
                            <tr >
                                <th  >STT</th>
                                <th >Tên sản phẩm</th>
                                <th >Số lượng</th>
                                <th >Giá tiền</th>
                            </thead>
                            <tbody>
                            @foreach($billInfo as $key => $bill)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $bill->product_name }}</td>
                                    <td>{{ $bill->quantily }}</td>
                                    <td>{{ number_format($bill->price) }} VNĐ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>Tổng tiền</b></td>
                                <td colspan="1"><b class="text-red">{{ number_format($customerInfo->bill_total) }} VNĐ</b></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                <div class="col-md-12 ">
                    <form action="{{ route('BillUpdate',$customerInfo->bill_id ) }}" method="get">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="form-inline pull-right">
                                <label>Trạng thái giao hàng: </label>
                                <select name="status" class="form-control input-inline" style="width: 200px">
                                    <option value="0"
                                    @if ($customerInfo->status == 0)
                                    selected="selected"
                                    @endif
                                    >
                                        Chưa giao
                                    </option>
                                    <option value="1"
                                    @if ($customerInfo->status == 1)
                                    selected="selected"
                                    @endif>Đã giao</option>
                                </select>

                                <input type="submit" value="Xử lý" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection