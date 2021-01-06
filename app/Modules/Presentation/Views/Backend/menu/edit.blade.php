@extends('Backend::layouts.master')
@section('javascript')
    <script type="text/javascript">
        var elements = {
            select_onsite: $('#{{ $form->onsite->getName() }}'),
            select_link_options: $('#{{ $form->link_options->getName() }}'),
            panel_id_content_cate: $('#id_content_cate'),
            panel_offpage: $('#offpage'),
            panel_onpage: $('#onpage')
        };
    </script>
    <script type="text/javascript" src="{{ asset('public/js/admin/menu/edit.js') }}"></script>
@endsection
@section('content')
    {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-files-o"></i> Menu</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
            @include('Backend::layouts.html.btn_cancel', ['route' => 'MenuIndex'])
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
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
                        <div class="col-md-12">
                            {!! form_row($form->icon) !!}
                        </div>
                        <div class="col-md-4">
                            {!! form_row($form->onsite) !!}
                        </div>
                        <div class="col-md-4">
                            <div id="onpage" style="display: none">
                                {!! form_row($form->link_options) !!}
                            </div>
                            <div id="offpage" style="display: none">
                                {!! form_row($form->link) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="id_content_cate" style="display: none">
                                {!! form_row($form->id_link) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! form_row($form->target) !!}
                        </div>
                        <div class="col-md-12">
                            {!! form_row($form->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    {!! form_row($form->menutype_id) !!}
                    {!! form_row($form->parent_id) !!}
                    {!! form_row($form->status) !!}
                    {!! form_row($form->language) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Sắp xếp thứ tự</h5>
                    {!! form_row($form->ordering_options) !!}
                    {!! form_row($form->ordering) !!}
                </div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
@endsection
