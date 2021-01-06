@extends('Backend::layouts.master')
@section('javascript')
    <script type="text/javascript" src="{{ asset('public/js/admin/jquery.uploadimage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/node_modules/jquery-ui-dist/jquery-ui.min.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/node_modules/jquery-ui-dist/jquery-ui.min.css') }}"/>
@endsection

@section('content')
    {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-files-o"></i> Sản phẩm</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'ProductsIndex'])
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
                    {!! form_row($form->content) !!}
                    <div>
                        <a onclick="this.remove()" data-toggle="collapse" href="#collapseDescription" role="button"
                           aria-expanded="false"
                           aria-controls="collapseDescription">Thêm mô tả ngắn</a>
                    </div>
                    <div class="collapse" id="collapseDescription">
                        {!! form_row($form->description) !!}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Ảnh sản phẩm</h5>
                    <div id="avatar"></div>
                    <script>
                        $(document).ready(function (e) {
                            $('#avatar').UploadImage({
                                input_name: 'images',
                                url_upload: '{{ route('ContentAjaxUpload') }}',
                                folder_tmp: '{{ config('define.folder_tmp') }}',
                                folder_upload: '{{ config('define.folder.products') }}',
                                folder_upload_thumb: '{{ config('define.folder.products_thumb') }}',
                                is_multiple: true,
                                image: '{{ $form->getModel()->images }}',
                                url_delete: '{{ route('ProductsDeleteImage', [$form->getModel()->id, '']) }}'
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Giá sản phẩm</h5>
                    <div class="row">
                        <div class="col-12">
                            {!! form_row($form->price_contact) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->price) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->price_compare) !!}
                        </div>
                        <div class="col-12">
                            {!! form_row($form->vat) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Kho hàng</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->sku) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->barcode) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->inventory) !!}
                        </div>
                        <div class="col-md-3 inventory-hidden" style="display: none">
                            {!! form_row($form->quantity) !!}
                        </div>
                        <div class="col-12 inventory-hidden" style="display: none">
                            {!! form_row($form->inventory_policy) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Kết quả tìm kiếm SEO</h5>
                    <hr>
                    <div>
                        <div style="color: #1a0dab; font-size: 1.2rem">
                            {{ $form->getModel()->meta_title }}
                        </div>
                        <div style="color: #006621">
                            {{ route('FrontendProduct', $form->getModel()->alias) }}
                        </div>
                        <div class="color-light-black" style="font-size: 0.97rem">
                            {{ $form->getModel()->meta_description }}
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="mb-4">
                        <a data-toggle="collapse" href="#collapseSeoPanel" role="button"
                           aria-expanded="false"
                           aria-controls="collapseSeoPanel">Chỉnh sửa SEO</a>
                    </div>
                    <div class="collapse" id="collapseSeoPanel">
                        {!! form_row($form->meta_title) !!}
                        {!! form_row($form->meta_description) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Trạng thái</h5>
                    {!! form_row($form->status) !!}
                    {!! form_row($form->publish_up) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Phân loại</h5>
                    {!! form_row($form->category_id) !!}
                    {{--{!! form_row($form->vendor_id) !!}--}}
                    {{--<div class="form-group">
                        <label for="group" class="control-label">{{ $form->group->getOptions()['label'] }}</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-default"
                                data-dropup-auto="false" data-none-selected-text="" multiple="" name="group[]"
                                tabindex="-98" title="">
                            @foreach($form->group->getOptions()['choices'] as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>--}}
                    {!! form_row($form->tags) !!}
                    {!! form_row($form->language) !!}
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('content');
            CKEDITOR.replace('description');

            inventory();

            function inventory() {
                if ($('#inventory').val() === '1') {
                    $('.inventory-hidden').fadeIn('normal');
                } else {
                    $('.inventory-hidden').fadeOut('normal');
                }
            };

            $('#inventory').change(function (e) {
                inventory();
            });
        });
    </script>
@endsection
