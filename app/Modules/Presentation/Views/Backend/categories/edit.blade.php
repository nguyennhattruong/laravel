@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-files-o"></i> Categories</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'CategoriesIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    @include('Backend::layouts.message')
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->title) !!}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! form_label($form->alias) !!}
                                {!! form_widget($form->alias) !!}
                                @if (Session::has('error_alias'))
                                    <span class="text-danger">{!! Session::get('error_alias') !!}</span>
                                @endif
                                {!! form_errors($form->alias) !!}
                            </div>
                        </div>
                    </div>
                    {!! form_row($form->description) !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    {!! form_row($form->parent_id) !!}
                    {!! form_row($form->status) !!}
                    {!! form_row($form->language) !!}
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('description');
        });
    </script>
@endsection
