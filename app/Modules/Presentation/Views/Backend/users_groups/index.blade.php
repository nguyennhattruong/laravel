@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> Nhóm thành viên</h4>
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
                    @include('Backend::layouts.html.btn_add', ['route' => 'UsersGroupsInsert'])
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="50"><input type="checkbox" id="checkAll"></th>
                    <th>@sortablelink('title', 'Title')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="id[]" value="{{ $item->id }}" title="">
                        </td>
                        <td>
                            <a href="{{ route('UsersGroupsEdit', $item->id) }}">
                                @if($item->depth > 0)
                                    |
                                @endif
                                {{ str_repeat('- ', $item->depth) }} {{ $item->title }}</a><br>
                        </td>
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
