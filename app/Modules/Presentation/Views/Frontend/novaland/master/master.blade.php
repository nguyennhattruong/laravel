@extends('Frontend::system.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/themes/novaland/css/style.css') }}">
@endsection

@section('header')
    <header style="background-image: none" class="header sticky-top bg-white">
        <div class="shadow-sm transition-duration-05">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="d-block d-lg-none color-white mt-4 float-left"
                             data-coco="scroll" data-addclass="color-black" data-removeclass="color-white">
                        <span class="cur-pointer font-size-2 text-change" data-coco="menu">
                            <i class="fas fa-bars"></i>
                        </span>
                        </div>
                        <a href="{{ url('') }}">
                            <div class="logo"></div>
                        </a>
                    </div>
                    <div class="col-lg-10">
                        @include(getView('master.widget_area'), ['position' => 'header_right'])
                    </div>
                    <a style="right:10px"
                       class="position-absolute btn btn-success btn-lg mt-4 bg-light-green border-0 font-play"
                       href="tel:0938363989">
                        <i class="fas fa-phone-alt mr-2"></i><strong>0938 36 39 89</strong>
                    </a>
                </div>
            </div>
        </div>
    </header>
@endsection
