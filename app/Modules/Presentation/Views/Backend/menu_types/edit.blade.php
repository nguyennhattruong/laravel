@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-file-text-o"></i> {{ trans('Backend::menu_types.page_edit_title') }}</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'MenuTypesIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('Backend::layouts.message')

                    {!! form_row($form->title) !!}
                    {!! form_row($form->description) !!}
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            {!! form_row($form->language) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
@endsection
