@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-files-o"></i> Pages Management</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'PagesIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
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
                    {!! form_row($form->layout) !!}
                    {!! form_row($form->description) !!}
                    {!! form_row($form->content) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {!! form_row($form->status) !!}
                    {!! form_row($form->language) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Thuộc tính</h5>
                    <div class="row">
                        @if(!empty($form->getModel()->attribs))
                            @foreach($form->getModel()->attribs as $key => $value)
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="text" name="attr_key[]" class="form-control" value="{{ $key }}">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="text" name="attr_value[]" class="form-control"
                                               value="{{ $value }}">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" name="attr_key[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" name="attr_value[]" class="form-control">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('content');
            CKEDITOR.replace('description', ckeditor_basic);
        });
    </script>
@endsection
