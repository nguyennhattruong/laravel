@extends('Frontend::system.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/themes/default/css/style.css') }}">
@endsection
@section('header')
    <header class="sticky-top bg-white shadow-sm">
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-4 col-md-5 col-lg-2">
                        @include(getView('master.widget_area'), ['position' => 'header_left'])
                    </div>
                    <div class="col-8 col-md-7 col-lg-10 mt-1">
                        <div class="float-left">
                            @include(getView('master.widget_area'), ['position' => 'header_right'])
                        </div>
                        <a href="{{ route('FrontendProductCheckout') }}"
                           class="btn btn-sm btn-outline-warning float-right mt-2">
                            <span class="mr-2"><i class="fas fa-shopping-cart font-size-1d3"></i></span>
                            <span class="font-size-1 bg-warning px-2 color-white rounded-circle"
                                  id="quantity_cart">
                                @if(!is_null(session('cart')))
                                    {{ count(session('cart')) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-orange">
            <div class="d-block d-md-none btn-menu-mobile pl-4 pt-1 color-white">
                <span class="cur-pointer font-size-2 text-change" data-coco="menu">
                    <i aria-hidden="true" class="fa fa-bars"></i>
                </span>
            </div>
        </div>
    </header>
@endsection

