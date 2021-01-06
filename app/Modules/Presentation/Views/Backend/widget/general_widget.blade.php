@extends('Backend::master.widgets')
@section('content')
    <div class="p-4">
        {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
        <div class="row">
            <div class="position-fixed" style="right: 10px; top: 10px; left: auto; z-index: 1000">
                {!! form_row($form->submit) !!}
            </div>
            <div class="col-md-6">{!! form_row($form->title) !!}</div>
            <div class="col-md-6">{!! form_row($form->link) !!}</div>
            <div class="col-md-4">{!! form_row($form->layout) !!}</div>
            <div class="col-md-4">{!! form_row($form->position) !!}</div>
            <div class="col-md-4">{!! form_row($form->language) !!}</div>
            <div class="col-md-3">{!! form_row($form->status) !!}</div>
            <div class="col-md-3">{!! form_row($form->show_title) !!}</div>
            <div class="col-12"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Section Class</label>
                    <input class="form-control" name="section_class" title=""
                           value="{{ $form->getModel()['session_class'] }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Section Attribute</label>
                    <input class="form-control" name="section_attr" title=""
                           value="{{ $form->getModel()['session_attr'] }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Header Class</label>
                    <input class="form-control" name="header_class" title=""
                           value="{{ $form->getModel()['header_class'] }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Header Attribute</label>
                    <input class="form-control" name="header_attr" title=""
                           value="{{ $form->getModel()['header_attr'] }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Body Class</label>
                    <input class="form-control" name="body_class" title=""
                           value="{{ $form->getModel()['body_class'] }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="options" class="control-label">Body Attribute</label>
                    <input class="form-control" name="body_attr" title=""
                           value="{{ $form->getModel()['body_attr'] }}"/>
                </div>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend>Tùy chỉnh</legend>
                    <div class="mb-4">
                        {!! form_rest($form) !!}
                    </div>
                </fieldset>
            </div>
        </div>
        {!! form_end($form, false) !!}
    </div>
@endsection
