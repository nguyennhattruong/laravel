@extends('Backend::layouts.master')
@section('javascript')
    <script type="text/javascript" src="{{ asset('public/js/admin/jquery.uploadimage.js') }}"></script>
@endsection
@section('content')
    {!! form_start($form) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-file-text-o"></i> {{ trans('Backend::content.page_edit_title') }}</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'ContentIndex'])
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
                        <div class="col-12">
                            {!! form_row($form->introtext) !!}
                        </div>
                        <div class="col-12">
                            {!! form_row($form->fulltext) !!}
                        </div>
                        <div class="col-6">
                            {!! form_row($form->author) !!}
                        </div>
                        <div class="col-6">
                            {!! form_row($form->source) !!}
                        </div>
                    </div>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Hình ảnh</h5>
                    <div id="avatar"></div>
                    <script>
                        $(document).ready(function (e) {
                            $('#avatar').UploadImage({
                                input_name: 'image',
                                input_name_old: 'image_old',
                                url_upload: '{{ route('ContentAjaxUpload') }}',
                                folder_tmp: '{{ config('define.folder_tmp') }}',
                                folder_upload: '{{ config('define.folder.content') }}',
                                folder_upload_thumb: '{{ config('define.folder.content_thumb') }}',
                                image: '{{ $image }}'
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! form_row($form->category_id) !!}
                    {!! form_row($form->language) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tình trạng</h5>
                    {!! form_row($form->status) !!}
                    {!! form_row($form->publish_up) !!}
                    {!! form_row($form->publish_down) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Giao diện</h5>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            {!! form_widget($form->layout_type) !!}
                        </div>
                        <div class="col-md-12">
                            {!! form_widget($form->layout) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('fulltext');
        });
    </script>
@endsection
