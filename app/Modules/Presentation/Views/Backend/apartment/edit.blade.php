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
            <h4><i class="fa fa-files-o"></i> Căn hộ</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'ApartmentIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('Backend::layouts.message')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a target="_new" class="color-indigo font-size-1d5"
                               href="{{ route('FrontApartment', $form->getModel()->alias) }}">{{ route('FrontApartment', $form->getModel()->alias) }}</a>
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->name) !!}
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
                    <h5>Ảnh căn hộ</h5>
                    <div id="avatar"></div>
                    <script>
                        $(document).ready(function (e) {
                            $('#avatar').UploadImage({
                                input_name: 'images',
                                url_upload: '{{ route('ContentAjaxUpload') }}',
                                folder_tmp: '{{ config('define.folder_tmp') }}',
                                folder_upload: '{{ config('define.folder.apartment') }}',
                                folder_upload_thumb: '{{ config('define.folder.apartment_thumb') }}',
                                is_multiple: true,
                                image: '{{ $form->getModel()->images }}',
                                url_delete: '{{ route('ApartmentDeleteImage', [$form->getModel()->id, '']) }}'
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Chi tiết căn hộ</h5>
                    <div class="row">
                        <div class="col-md-4">{!! form_row($form->price) !!}</div>
                        <div class="col-md-4">{!! form_row($form->code) !!}</div>
                        <div class="col-md-4">{!! form_row($form->bedroom) !!}</div>
                        <div class="col-md-4">{!! form_row($form->bathroom) !!}</div>
                        <div class="col-md-4">{!! form_row($form->land_size) !!}</div>
                        <div class="col-md-4">{!! form_row($form->year_built) !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="mb-3">Trạng thái</h5>
                    {!! form_row($form->status) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Tiện ích</h5>
                    {!! form_widget($form->features) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="mb-3">Tình trạng</h5>
                    {!! form_widget($form->state) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="mb-3">Labels</h5>
                    {!! form_widget($form->label_id) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="mb-3">Loại căn hộ</h5>
                    {!! form_widget($form->type_id) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Dự án</h5>
                    {!! form_widget($form->location_id) !!}
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
                            {{ route('FrontApartment', $form->getModel()->alias) }}
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
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace('content', {
                height : '600px'
            });
            CKEDITOR.replace('description', ckeditor_basic);

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
