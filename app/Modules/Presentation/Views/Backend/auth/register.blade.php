@extends('Backend::layouts.master')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        <div class="header sticky-top">
            <div class="pull-left">
                <h4><i class="fa fa-user-o" aria-hidden="true"></i> Thêm tài khoản</h4>

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
                <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Tài khoản</label>
                            <div>
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fullname" class="control-label">Họ tên</label>
                            <input class="form-control" name="fullname" type="text" id="fullname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Mật khẩu</label>

                            <div>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Xác nhận mật khẩu</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Nhóm thành viên</label>
                        <select name="group_id" title="" class="form-control">
                            @foreach($group as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea class="form-control" name="remark" title=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
