@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> {{ trans('Backend::menu_types.page_title') }}
        </h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'GET']) !!}
            <div class="row">
                <div class="col-md-2 form-group">
                    {!! form_widget($form->title) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! form_widget($form->language) !!}
                </div>
                <div class="col-md-5 form-group">
                    {!! form_row($form->submit) !!}
                    @include('Backend::layouts.html.btn_reset', ['route' => 'MenuTypesIndex'])
                </div>
                <div class="col-md-12">
                    <div class="pull-left mr-1">
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
                    @include('Backend::layouts.html.btn_add', ['route' => 'MenuTypesInsert'])
                </div>
            </div>
            <div class="mb-1">{{ $data->total() }} Items</div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="checkAll"></th>
                    <th>@sortablelink('title', trans('Backend::content.table_title'))</th>
                    <th>@sortablelink('language', trans('Backend::content.table_language'))</th>
                    <th>@sortablelink('created_at', trans('Backend::content.table_created_at'))</th>
                    <th>@sortablelink('id', 'ID')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="id[]" value="{{ $item->id }}">
                        </td>
                        <td>
                            <a href="{{ route('MenuTypesEdit', $item->id) }}">{{ $item->title }}</a><br>
                        </td>
                        <td>{{ str_replace('*', 'All', $item->language) }}</td>
                        <td>{{ $item->created_at ? $item->created_at->format('Y-m-d H:i') : '' }}</td>
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
    <script type="text/javascript" src="{{ asset('public/js/admin/menu_types/index.js') }}"></script>
@endsection
