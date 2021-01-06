@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-html5"></i> Embed Script</h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form_start($form, $formOptions = ['method' => 'POST']) !!}
            <div class="form-group">
                <div id="main-script" class="row">
                    @if(isset($data->header_script))
                        @foreach($data->header_script as $key => $value)
                            @include('Backend::layouts.html.header_script', ['key' => $key, 'value' => $value])
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <a class="btn btn-success color-white btn-add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <script type="text/javascript">
                var html = '@include('Backend::layouts.html.header_script', ['key' => '', 'value' => ''])';
            </script>
            <script type="text/javascript" src="{{ asset('public/js/admin/config/embed_script.js') }}"></script>
            {!! form_end($form) !!}
        </div>
    </div>
@endsection
