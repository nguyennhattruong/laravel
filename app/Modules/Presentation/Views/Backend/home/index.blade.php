@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> Dashboard
        </h4>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 display-2 color-gray text-center">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-center color-gray font-roboto-condensed font-weight-300">{{ trans('Backend::home.total_content') }}</h3>
                            <p class="text-center color-orange display-4 mb-0">{{ $data['total_content'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-success btn-sm text-uppercase" href="{{ route('ContentInsert') }}">
                        <i class="fa fa-plus"></i> {{ trans('Backend::home.btn_add') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 display-2 color-gray text-center">
                            <i class="fa fa-folder-open-o"></i>
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-center color-gray font-roboto-condensed font-weight-300">{{ trans('Backend::home.total_categories') }}</h3>
                            <p class="text-center color-orange display-4 mb-0">{{ $data['total_categories'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-success btn-sm text-uppercase" href="{{ route('CategoriesInsert') }}">
                        <i class="fa fa-plus"></i> {{ trans('Backend::home.btn_add') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
