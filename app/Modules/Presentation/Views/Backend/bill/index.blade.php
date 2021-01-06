@extends('Backend::layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            Danh sách đơn hàng
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @if (Session::has('message'))
            <div class="alert alert-info"> {{ Session::get('message') }}</div>
    @endif
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-12">
                        <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead class="thead-dark">
                            <tr role="row">
                                <th >ID</th>
                                <th >Tên người order</th>
                                <th >Địa chỉ</th>
                                <th >Ngày đặt hàng</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th >Action</th>
                                <th>Xóa</th></tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        @if(!$customer->status)
                                        Chưa xử lý
                                        @else
                                        Đã xử lý
                                        @endif
                                    </td>
                                    <td><a href="{{ route('BillEdit', $customer->id) }} ">Detail</a></td>
                                    <td><a class="btn btn-danger" href="{{ route('BillDelete', $customer->bill_id) }} ">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('Backend::layouts.dialog_trash')
    <script type="text/javascript" src="{{ asset('public/js/admin/content/index.js') }}"></script>
@endsection
