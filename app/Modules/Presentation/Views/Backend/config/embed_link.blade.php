@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-html5"></i> Embed Header Link</h4>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            {!! form($form, $formOptions = ['method' => 'POST']) !!}
        </div>
    </div>
@endsection
