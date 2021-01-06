@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-files-o"></i> Nhóm phân quyền</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'UsersGroupsIndex'])
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            <div class="row">
                <div class="col-md-12">
                    {!! form_row($form->title) !!}
                </div>
                {{--<div class="col-md-3">
                    {!! form_row($form->parent_id) !!}
                </div>--}}
                <div class="col-md-12">
                    <div class="mb-2">Phân quyền</div>
                    <div class="border rounded p-3">
                        @php $count = 0; @endphp
                        @foreach(config('define.permission') as $key => $value)
                            <h6 class="mb-3"><strong>{{ $key }}</strong></h6>
                            <div class="row mb-4">
                                <div class="col-md-12 mb-3">
                                    <a class="btn btn-outline-success btn-sm" href="#" type="checkbox"
                                       id="all{{ $key }}" title=""
                                       onclick="$('.cb{{ $count }}').prop('checked', true);return false;"><i
                                                class="fa fa-check-square-o" aria-hidden="true"></i> Chọn tất cả</a>
                                    <a class="btn btn-outline-primary btn-sm" href="#" type="checkbox"
                                       id="all{{ $key }}" title=""
                                       onclick="$('.cb{{ $count }}').prop('checked', false);return false;"><i
                                                class="fa fa-times" aria-hidden="true"></i> Hủy tất cả</a>
                                </div>
                                @foreach($value as $val_key => $val_value)
                                    <div class="col-md-4 mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input @if(@in_array($val_key, $form->getModel()->rules)) {{ 'checked' }} @endif name="rules[]"
                                                   type="checkbox" class="custom-control-input cb{{ $count }}"
                                                   id="{{ $val_key }}" value="{{ $val_key }}" title="">
                                            <label class="custom-control-label"
                                                   for="{{ $val_key }}">{{ $val_value }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @php $count++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
@endsection
