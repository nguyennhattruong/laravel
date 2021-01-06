@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form, ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-cogs"></i> {{ trans('Backend::config.page_title') }}</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_rest($form, $formOptions = ['method' => 'POST']) !!}
        </div>
    </div>
    {!! form_end($form, false) !!}
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace("off_message", ckeditor_basic);
        });
    </script>
@endsection
