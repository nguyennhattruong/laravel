@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-cogs"></i> Metadata Settings</h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
            {!! form_row($form->meta_keywords) !!}
            {!! form_row($form->meta_robots) !!}
            <div class="row form-group">
                <div class="col-md-12">
                    <label>Extension Meta</label>
                </div>
                <div class="col-md-12 mb-2">
                    <table class="meta-extension">
                        @if (isset($data->meta_extension))
                            @foreach($data->meta_extension as $key => $value)
                                @include('Backend::layouts.html.meta_extension', ['key' => $key, 'value' => $value])
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-success color-white btn-add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <script type="text/javascript">
                var html = '@include('Backend::layouts.html.meta_extension', ['key' => '', 'value' => ''])';
            </script>
            <script type="text/javascript" src="{{ asset('public/js/admin/config/metadata.js') }}"></script>
            {!! form_end($form) !!}
        </div>
    </div>
@endsection
