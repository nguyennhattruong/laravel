@extends('Backend::layouts.master')
@section('content')
    {!! form_start($form, ['method' => 'POST']) !!}
    <div class="header sticky-top">
        <div class="pull-left">
            <h4><i class="fa fa-envelope-o"></i> {{ trans('Backend::config.mail_setting_title') }}</h4>
        </div>
        <div class="pull-right">
            {!! form_row($form->submit) !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @include('Backend::layouts.message')
            <div class="row">
                <div class="col-md-6">{!! form_row($form->mail_from) !!}</div>
                <div class="col-md-6">{!! form_row($form->from_name) !!}</div>
                <div class="col-md-6">{!! form_row($form->reply_to_email) !!}</div>
                <div class="col-md-6">{!! form_row($form->reply_to_name) !!}</div>
                <div class="col-md-3">{!! form_row($form->mailer) !!}</div>
                <div class="col-md-3">{!! form_row($form->smtp_host) !!}</div>
                <div class="col-md-3">{!! form_row($form->smtp_port) !!}</div>
                <div class="col-md-3">{!! form_row($form->smtp_secure) !!}</div>
                <div class="col-md-12">{!! form_row($form->smtp_auth) !!}</div>
                <div class="col-md-6">{!! form_row($form->smtp_user) !!}</div>
                <div class="col-md-6">{!! form_row($form->smtp_pass) !!}</div>
            </div>
        </div>
    </div>
    {!! form_end($form, false) !!}
@endsection
