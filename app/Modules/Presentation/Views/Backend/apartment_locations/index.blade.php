@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> Dự án</h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'GET']) !!}
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! form_widget($form->name) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! form_widget($form->language) !!}
                </div>
                <div class="col-md-5 form-group">
                    {!! form_row($form->submit) !!}
                    @include('Backend::layouts.html.btn_reset', ['route' => 'ApartmentLocationsIndex'])
                </div>
                <div class="col-md-12">
                    <div class="pull-left mr-2">
                        {!! form_widget($form->status) !!}
                    </div>
                    <div class="pull-left mr-2">
                        {!! form_widget($form->display) !!}
                    </div>
                </div>
            </div>
            {!! form_end($form, false) !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {!! form_start($formGrid) !!}
            <div class="row">
                <div class="col-md-12">
                    @if ($formGrid->delete)
                        <div class="pull-left mr-2 form-group">
                            {!! form_widget($formGrid->delete) !!}
                        </div>
                    @endif
                <!-- Button Add-->
                    @include('Backend::layouts.html.btn_add', ['route' => 'ApartmentLocationsInsert'])
                </div>
            </div>
            <div class="mb-1">{{ $data->total() }} Items</div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="checkAll"></th>
                    <th width="90" class="text-center">@sortablelink('status', 'Tình trạng')</th>
                    <th width="64"></th>
                    <th>@sortablelink('name', 'Tên dự án')</th>
                    <th>@sortablelink('language', 'Ngôn ngữ')</th>
                    <th>@sortablelink('created_at', 'Ngày tạo')</th>
                    <th>@sortablelink('id', 'ID')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="id[]" value="{{ $item->id }}">
                        </td>
                        <td class="text-center">
                            @if ($item->status == \App\Modules\Domain\Models\ApartmentLocations::STATUS_PUBLISHED)
                                <i class="fa fa-check color-green"></i>
                            @elseif ($item->status == \App\Modules\Domain\Models\ApartmentLocations::STATUS_UNPUBLISHED)
                                <i class="fa fa-times color-red"></i>
                            @endif
                        </td>
                        <td>
                            <img width="64"
                                 src="{{ getThumbImage($item->image, 'define.folder.apartment_locations_thumb') }}">
                        </td>
                        <td>
                            <a href="{{ route('ApartmentLocationsEdit', $item->id) }}">
                                @if($item->depth > 0)
                                    |
                                @endif
                                {{ str_repeat('- ', $item->depth) }} {{ $item->name }}</a><br>
                            <small>(Alias: {{ $item->alias }})</small>
                        </td>
                        <td>{{ str_replace('*', 'All', $item->language) }}</td>
                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $data->links('Backend::layouts.html.pagination') }}
            </div>
            {!! form_end($formGrid, false) !!}
        </div>
    </div>
    @include('Backend::layouts.dialog_trash')
@endsection
