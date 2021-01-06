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
            <h4><i class="fa fa-files-o"></i> Dự án</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'ApartmentLocationsIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>
                <a target="_new" class="color-indigo font-size-1d5"
                   href="{{ route('FrontApartmentLocationsDetail', $form->getModel()->alias) }}">{{ route('FrontApartmentLocationsDetail', $form->getModel()->alias) }}</a>
            </h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('Backend::layouts.message')
                    <div class="row">
                        <div class="col-md-12">
                            {!! form_widget($form->status) !!}
                        </div>
                        <div class="col-md-6">
                            <h5>Ảnh dự án</h5>
                            <div id="avatar"></div>
                            <script>
                                $(document).ready(function (e) {
                                    $('#avatar').UploadImage({
                                        input_name: 'image',
                                        input_name_old: 'image_old',
                                        url_upload: '{{ route('ContentAjaxUpload') }}',
                                        folder_tmp: '{{ config('define.folder_tmp') }}',
                                        folder_upload: '{{ config('define.folder.apartment_locations') }}',
                                        folder_upload_thumb: '{{ config('define.folder.apartment_locations_thumb') }}',
                                        image: '{{ $image }}'
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-12"></div>
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
                    {!! form_row($form->description) !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseOverview"
                    aria-expanded="true" aria-controls="collapseOverview">
                Tổng quan <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse show" id="collapseOverview">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=overviewImage&multiple=0&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->overviewImage }}" name="overviewImage"
                                   id="overviewImage"
                                   class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="overviewContent" id="overviewContent" class="form-control">
                            {{ $form->getModel()->overviewContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapsePosition"
                    aria-expanded="true" aria-controls="collapsePosition">
                Vị trí <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse show" id="collapsePosition">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=positionImage&multiple=0&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->positionImage }}" id="positionImage"
                                   name="positionImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="positionContent" id="positionContent" class="form-control">
                            {{ $form->getModel()->positionContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseUtility"
                    aria-expanded="false" aria-controls="collapseUtility">
                Mặt bằng thiết kế - Tiện ích căn hộ <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse" id="collapseUtility">
                <div class="card-body">
                    <div class="custom-control custom-switch form-group">
                        <input @if($form->getModel()->utilityShow) checked @endif name="utilityShow" type="checkbox" class="custom-control-input" id="utilityShow">
                        <label class="custom-control-label" for="utilityShow">Hiển thị</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=utilityImage&multiple=1&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->utilityImage }}" id="utilityImage"
                                   name="utilityImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseOneRoom"
                    aria-expanded="false" aria-controls="collapseOneRoom">
                Căn 1 phòng ngủ <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse" id="collapseOneRoom">
                <div class="card-body">
                    <div class="custom-control custom-switch form-group">
                        <input @if($form->getModel()->oneShow) checked @endif name="oneShow" type="checkbox" class="custom-control-input" id="oneShow">
                        <label class="custom-control-label" for="oneShow">Hiển thị</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=oneImage&multiple=1&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->oneImage }}" id="oneImage"
                                   name="oneImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="oneContent" id="oneContent" class="form-control">
                            {{ $form->getModel()->oneContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseTwoRoom"
                    aria-expanded="false" aria-controls="collapseTwoRoom">
                Căn 2 phòng ngủ <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse" id="collapseTwoRoom">
                <div class="card-body">
                    <div class="custom-control custom-switch form-group">
                        <input @if($form->getModel()->twoShow) checked @endif name="twoShow" type="checkbox" class="custom-control-input" id="twoShow">
                        <label class="custom-control-label" for="twoShow">Hiển thị</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=twoImage&multiple=1&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->twoImage }}" id="twoImage"
                                   name="twoImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="twoContent" id="twoContent" class="form-control">
                            {{ $form->getModel()->twoContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseThreeRoom"
                    aria-expanded="false" aria-controls="collapseThreeRoom">
                Căn 3 phòng ngủ <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse" id="collapseThreeRoom">
                <div class="card-body">
                    <div class="custom-control custom-switch form-group">
                        <input @if($form->getModel()->threeShow) checked @endif name="threeShow" type="checkbox" class="custom-control-input" id="threeShow">
                        <label class="custom-control-label" for="threeShow">Hiển thị</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=threeImage&multiple=1&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->threeImage }}" id="threeImage"
                                   name="threeImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="threeContent" content="threeContent" id="threeContent" class="form-control">
                            {{ $form->getModel()->threeContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-lg mb-3" type="button" data-toggle="collapse"
                    data-target="#collapseOfficeTel"
                    aria-expanded="false" aria-controls="collapseOfficeTel">
                Office tel <i class="fa fa-arrows-v ml-1" aria-hidden="true"></i>
            </button>
            <div class="card collapse" id="collapseOfficeTel">
                <div class="card-body">
                    <div class="custom-control custom-switch form-group">
                        <input @if($form->getModel()->officeShow) checked @endif name="officeShow" type="checkbox" class="custom-control-input" id="officeShow">
                        <label class="custom-control-label" for="officeShow">Hiển thị</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a href="{{ url('public/plugins') }}/filemanager/dialog.php?type=2&field_id=officeImage&multiple=1&akey=f082bb76e751504cec75782056627a84&langCode=vi"
                                   data-toggle="modal" data-target=".bd-example-modal-xl"
                                   class="btn btn-success iframe-btn"
                                   type="button"><i class="fa fa-picture-o"
                                                    aria-hidden="true"></i> Hình ảnh
                                </a>
                            </div>
                            <input value="{{ $form->getModel()->officeImage }}" id="officeImage"
                                   name="officeImage" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="officeContent" id="officeContent" class="form-control">
                            {{ $form->getModel()->officeContent }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="col-md-12">--}}
        {{--<div class="card">--}}
        {{--<div class="card-body">--}}
        {{--{!! form_row($form->content) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            // CKEDITOR.replace('content', {
            //     height: '600px'
            // });
            CKEDITOR.replace('description', ckeditor_basic);
            CKEDITOR.replace('overviewContent', ckeditor_basic);
            CKEDITOR.replace('positionContent', ckeditor_basic);
            CKEDITOR.replace('oneContent', ckeditor_basic);
            CKEDITOR.replace('twoContent', ckeditor_basic);
            CKEDITOR.replace('threeContent', ckeditor_basic);
            CKEDITOR.replace('officeContent', ckeditor_basic);

            $('.iframe-btn').click(function (e) {
                $('#iframe').attr('src', $(this).attr('href'));
            });
        });
    </script>
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <iframe id="iframe" width="100%" height="600" frameborder="0" src=""></iframe>
            </div>
        </div>
    </div>
@endsection
