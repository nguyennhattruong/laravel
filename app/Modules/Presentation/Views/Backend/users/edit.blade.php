@extends('Backend::layouts.master')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('UsersEdit', $form->getModel()->id) }}">
        <div class="header sticky-top">
            <div class="pull-left">
                <h4><i class="fa fa-user-o" aria-hidden="true"></i> Thành viên</h4>

            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i> Lưu
                </button>
                <a class="btn btn-danger" href="{{ route('UsersIndex') }}"><i class="fa fa-times"></i>
                    Hủy</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @include('Backend::layouts.message')
                <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        {!! form_row($form->name) !!}
                    </div>
                    <div class="col-md-12">
                        {!! form_row($form->fullname) !!}
                    </div>
                    <div class="col-md-6">
                        {!! form_row($form->password) !!}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Xác nhận mật khẩu</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->group_id) !!}
                    </div>
                    <div class="col-md-12">
                        {!! form_row($form->remark) !!}
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
