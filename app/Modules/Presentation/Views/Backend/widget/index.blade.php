@extends('Backend::layouts.master')
@section('javascript')
    <script type="text/javascript" src="{{ asset('public/node_modules/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/widget/index.js') }}"></script>
    <script type="text/javascript">
        var url_add = '{{ route('WidgetStore') }}';
        var url_update = '{{ route('WidgetUpdate') }}';
    </script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/node_modules/jquery-ui-dist/jquery-ui.min.css') }}"/>
@endsection
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> Widget
        </h4>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1">Widgets</h5>
                    <small class="text-muted">Kéo thả qua <span class="color-deep-orange">Template</span> để thêm mới
                        Widget.
                    </small>
                    <div class="mt-4">
                        @foreach($data['widgets'] as $widKey => $widValue)
                            <div class="widget-item draggable" data-widget="{{ $widKey }}"
                                 data-widget-description="{{ $widValue['name'] }}">
                                <span>{{ $widValue['name'] }}</span>
                                <div class="pull-right d-none">
                                    <a class="btn btn-outline-secondary p-0 pr-2 pl-2"
                                       href="#" data-toggle="tooltip"
                                       data-placement="top" title="Config"
                                       data-widget-action="config"
                                       onclick="show_wid(this)">
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-outline-secondary p-0 pr-2 pl-2"
                                       href="#" data-toggle="tooltip"
                                       data-placement="top" title="Delete"
                                       data-widget-action="delete"
                                       onclick="delete_wid(this)">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="pl-3 pr-3 mb-3">
                                <small class="text-muted">{{ $widValue['description'] }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Template</h5>
                    <div class="row">
                        @foreach($data['position'] as $key => $value)
                            <div class="col-md-6">
                                <div class="card draggable-holder">
                                    <div class="card-body">
                                        <h5 class="card-title mb-1">{{ $key }}</h5>
                                        <small class="text-muted">Kéo thả để điều chỉnh vị trí hiển thị trên <span
                                                    class="color-deep-orange">{{ $key }}</span>.
                                        </small>
                                        <div>
                                            <div class="sortable pt-4" data-widget="{{ $key }}">
                                                @foreach($value as $item)
                                                    <div class="widget-item"
                                                         id="{{ $item['id'] }}">
                                                        <span>{{ $item['title'] }}
                                                            <small>(ID: {{ $item['id'] }})</small>
                                                        </span>
                                                        <div class="pull-right">
                                                            <a class="btn btn-outline-secondary p-0 pr-2 pl-2"
                                                               href="#" data-toggle="tooltip"
                                                               data-placement="top" title="Config"
                                                               data-widget-action="config"
                                                               data-widget-id="{{ $item['id'] }}"
                                                               onclick="show_wid(this)">
                                                                <i class="fa fa-cog" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="btn btn-outline-secondary p-0 pr-2 pl-2"
                                                               href="#" data-toggle="tooltip"
                                                               data-placement="top" title="Delete"
                                                               data-widget-action="delete"
                                                               data-widget-id="{{ $item['id'] }}"
                                                               onclick="delete_wid(this)">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-x-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Widget</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 m-0"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
