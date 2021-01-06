@extends('Frontend::system.master')
@section('css')
@endsection
@section('header')
    <header>
        {{--        @include(getView('master.widget_area'), ['position' => 'header_footer'])--}}
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xs-12 flex-center">
                        <a href="{{ url('') }}"><img width="50%" src="{{ asset('public/themes/main/images/logo.png')}}" alt="Logo"></a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xs-12 text-center">
                        <h1 class="color-red">Cửa hàng bán laptop</h1>
                        <h4>Dell - HP - Asuz - Acer</h4>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xs-12 ">
                        <div class="row">
                            {{--<div class="col-md-12">--}}
                            <a class="cart d-none d-lg-block" href="{{ asset('/gio-hang')}}"><img class="mr-1"
                                                                                                  src="{{ asset('public/themes/main/images/giohang.png')}}"
                                                                                                  alt="Giỏ hàng">Shopping
                                Cart (<strong id="quantity_cart">
                                    @if (!is_null(session('cart')))
                                        {{ count(session('cart')) }}
                                    @else
                                        0
                                    @endif
                                </strong>)</a>
                            {{--</div>--}}
                        </div>
                        <div class="row mt-2 d-none d-lg-block">
                            <div class="hotline">
                                <div class="row">
                                    <div class="col-md-3 col-xs-3">
                                        <img src="{{ asset('public/themes/main/images/247.png')}}" alt="147">
                                    </div>
                                    <div class="col-md-9 col-xs-9 line-hotline">
                                        <p>0903333333</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="narbar" style="position: relative;">

            @include(getView('master.widget_area'), ['position' => 'header_footer'])
        </div>
        <div class="bg-red" id="nar-mb">

            <a class="cart cart-mb d-md-block d-lg-none" href="{{ asset('/gio-hang')}}"><img class="mr-1"
                                                                                             src="{{ asset('public/themes/main/images/giohang.png')}}"
                                                                                             alt="Giỏ hàng">Shopping
                Cart (<strong id="quantity_cart">
                    @if (!is_null(session('cart')))
                        {{ count(session('cart')) }}
                    @else
                        0
                    @endif
                </strong>)
            </a>

            <div class="d-block d-lg-none btn-menu-mobile pl-4 color-white">
                <span class="cur-pointer font-size-2 text-change" data-coco="menu">
                    <i aria-hidden="true" class="fa fa-bars"></i>
                </span>
            </div>
        </div>


    </header>
@endsection
@section('slider')
    <section class="container mt-4">
        <section class="row justify-content-center">
            {{--            <section class="col-md-3">--}}
            {{--                @include(getView('master.widget_area'), ['position' => 'body_left'])--}}
            {{--            </section>--}}
            <section class="col-md-11 pb-2">
                @include(getView('master.widget_area'), ['position' => 'body_right'])
            </section>
        </section>
    </section>
@endsection

@section('left-content')
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
        <div class="sub_left">
            <div class="title_left"><span>Hỗ trợ trực tuyến</span></div>
            <div class="content_left">
                <div class="dienthoai_hotro">
                    <div class="img_hotro">
                        <img src="{{ asset('public/images/add-4700.jpg')}}" alt="Hỗ trợ">
                    </div>
                    <p>Hotline:</p>
                    <span>0903333333</span>
                    <div class="clear"></div>
                </div>
                <div class="item_hotro">
                    <div class="top_hotro">
                        <div class="icon_hotro">
                            <a href="https://www.facebook.com/Shop-Chuy%C3%AAn-S%E1%BB%89-M%E1%BB%B9-Ph%E1%BA%A9m-V%C3%A0-Sextoy-420968678353735/"
                               target="_blank"><img src='{{ asset("public/images/facebook.png")}}' alt="Facebook"></a>
                            <a href="viber://add?number="><img src='{{ asset("public/images/viber.png")}}' alt="Viber"></a>
                            <a href="https://zalo.me/" target="_blank"><img src="{{ asset('public/images/zalo.png')}}"
                                                                            alt="Zalo"></a>
                        </div>
                        <div class="dienthoai_hotro">
                            <p>Hổ trợ trực tuyến</p>
                            <span>0903333333</span>
                        </div>
                    </div>
                    <div class="email_hotro"><img src="{{ asset('public/images/email.png')}}" alt="Email"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="content_footer">
                        <h3 style="line-height: 21px; margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial; font-size: 14px; text-align: justify;">
                            <span style="font-size: 24px;"><span
                                        style="color: rgb(255, 0, 0);"><strong>Shop Laptop</strong></span></span>
                        </h3>

                        <p style="margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial; font-size: 14px; line-height: 21px; text-align: justify;"><span
                                    style="color:#F0FFF0;">1 Tôn Đức Thắng, Quận 1, Tp. HCM
                            <br>
                            Điện thoại: &nbsp;0903 333 333<br>
                            Email: info@gmail.com<br>
                            Website:&nbsp;shoplaptop.com</span></p>
                    </div>
                    <div class="social-footer">
                        <a href="http://facebook.com/" target="blank"><img src="{{ asset('public/images/fb.png')}}"
                                                                           alt="Facebook"></a>
                        <a href="https://twitter.com/" target="blank"><img src="{{ asset('public/images/tw.png')}}"
                                                                           alt="twitter"></a>
                        <a href="https://www.google.com/" target="blank"><img src="{{ asset('public/images/gg.png')}}"
                                                                              alt="G+"></a>
                        <a href="https://www.youtube.com/" target="blank"><img src="{{ asset('public/images/yt.png')}}"
                                                                               alt="Youtube"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="title_footer">Chăm sóc khách hàng</div>
                    <div class="content_footer">
                    </div>
                    <div class="logo_bocongthuong">
                        <a href="http://www.microsoft.com/" target="_blank"><img width="100%"
                                                                                 src="{{ asset('public/images/logo-microsoft.png')}}"
                                                                                 alt=""
                                                                                 class="mw100"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="title_footer">Thống kê truy cập</div>
                    <div class="content_footer">
                        <ul class="list_thongke">
                            <li class="tk_online">Đang online : <span>1</span></li>
                            <li class="tk_today">Hôm nay : <span>2</span></li>
                            <li class="tk_week">Tuần này : <span>12</span></li>
                            <li class="tk_all">Tổng truy cập : <span>12</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer_end">
        <div class="container">
            <div class="copy">Copyright © 2021. All rights reserved.</div>
        </div>
    </div>

@endsection
