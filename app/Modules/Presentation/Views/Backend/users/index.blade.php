@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-users" aria-hidden="true"></i> Danh sách tài khoản</h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'GET']) !!}
            <div class="row">
                <div class="col-md-3">
                    {!! form_widget($form->name) !!}
                </div>
                <div class="col-md-2">
                    {!! form_widget($form->display) !!}
                </div>
                <div class="col-md-7">
                    {!! form_row($form->submit) !!}
                </div>
            </div>
            {!! form_end($form, false) !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {!! form_start($formGrid) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left mr-2 form-group">
                        {!! form_widget($formGrid->delete) !!}
                    </div>
                    <!-- Button Add-->
                    <a class="btn btn-success pull-right" href="{{ route('register') }}">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
            <div class="mb-1">Số tài khoản: <strong>{{ $data->total() }}</strong></div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="50" class="text-center"><input type="checkbox" id="checkAll"></th>
                    <th width="50">@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('name', 'Tài khoản')</th>
                    <th>Họ tên</th>
                    <th>Nhóm thành viên</th>
                    <th>Ghi chú</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="id[]" value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('UsersEdit', $item->id) }}">{{ $item->name }}</a>
                        </td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ @$item->group->title }}</td>
                        <td>{{ $item->remark }}</td>
                        <td class="text-right">
                            <a href="{{ route('UsersEdit', $item->id) }}" class="btn btn-success btn-sm mb-2">
                                <i class="fa fa-pencil-square-o"></i> Sửa
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $data->links('Backend::layouts.html.pagination') }}
            </div>
            {!! form_end($formGrid, false) !!}
        </div>
    </div>
    @include('Backend::layouts.dialog_trash')
    <script type="text/javascript" src="{{ asset('public/js/admin/users/index.js') }}"></script>
@endsection
