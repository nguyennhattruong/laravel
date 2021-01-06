@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> {{ trans('Backend::content.page_title') }}
        </h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'GET']) !!}
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! form_widget($form->title) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! form_widget($form->category_id) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! form_widget($form->language) !!}
                </div>
                <div class="col-md-5 form-group">
                    {!! form_row($form->submit) !!}
                    @include('Backend::layouts.html.btn_reset', ['route' => 'ContentIndex'])
                </div>
                <div class="col-md-12">
                    <div class="pull-left mr-1">
                        {!! form_widget($form->status) !!}
                    </div>
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
                    @if ($formGrid->trash)
                        <div class="pull-left mr-2 form-group">
                            {!! form_widget($formGrid->trash) !!}
                        </div>
                    @endif
                    @if ($formGrid->update_cate)
                        <div class="pull-left mr-2 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! form_widget($formGrid->update_cate) !!}
                                </div>
                                {!! form_widget($formGrid->cate) !!}
                            </div>
                        </div>
                    @endif
                    @if ($formGrid->update_status)
                        <div class="pull-left mr-2 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! form_widget($formGrid->update_status) !!}
                                </div>
                                {!! form_widget($formGrid->status_to) !!}
                            </div>
                        </div>
                    @endif
                    @if ($formGrid->restore)
                        <div class="pull-left mr-2 form-group">
                            {!! form_widget($formGrid->restore) !!}
                        </div>
                    @endif
                    @if ($formGrid->delete)
                        <div class="pull-left mr-2 form-group">
                            {!! form_widget($formGrid->delete) !!}
                        </div>
                    @endif
                <!-- Button Add-->
                    @include('Backend::layouts.html.btn_add', ['route' => 'ContentInsert'])
                </div>
            </div>
            <div class="mb-1">{{ $data->total() }} Items</div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="checkAll"></th>
                    <th width="70" class="text-center">@sortablelink('status', trans('Backend::content.table_status'))
                    </th>
                    <th>@sortablelink('title', trans('Backend::content.table_title'))</th>
                    <th>Image</th>
                    <th>@sortablelink('category.title', trans('Backend::content.table_category'))</th>
                    <th>@sortablelink('author', trans('Backend::content.table_author'))</th>
                    <th>@sortablelink('language', trans('Backend::content.table_language'))</th>
                    <th>@sortablelink('created_at', trans('Backend::content.table_created_at'))</th>
                    <th>@sortablelink('hits', trans('Backend::content.table_hits'))</th>
                    <th>@sortablelink('id', 'ID')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="contentId[]" value="{{ $item->id }}">
                        </td>
                        <td class="text-center">
                            @if ($item->status == \App\Modules\Domain\Models\Content::STATUS_PUBLISHED)
                                <i class="fa fa-check color-green"></i>
                            @elseif ($item->status == \App\Modules\Domain\Models\Content::STATUS_UNPUBLISHED)
                                <i class="fa fa-times color-red"></i>
                            @elseif ($item->status == \App\Modules\Domain\Models\Content::STATUS_TRASH)
                                <i class="fa fa-ban color-red"></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('ContentEdit', $item->id) }}">{{ $item->title }}</a><br>
                            <small>
                                <a class="color-light-black" target="_blank" href="{{ route('SiteContent', $item->alias) }}">
                                    {{ route('SiteContent', $item->alias) }}
                                </a>
                            </small>
                        </td>
                        <td>
                            <img width="64px" src="{{ getThumbImage($item->image, 'define.folder.content') }}">
                        </td>
                        <td>{{ @$item->category->title }}<br>
                            <small>(Alias: {{ @$item->category->alias }})</small>
                        </td>
                        <td>{{ $item->author }}</td>
                        <td>{{ str_replace('*', 'All', $item->language) }}</td>
                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->hits }}</td>
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
    <script type="text/javascript" src="{{ asset('public/js/admin/content/index.js') }}"></script>
@endsection
