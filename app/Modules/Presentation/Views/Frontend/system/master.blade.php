<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include(getView('master.meta'))
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome v5.7.2 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- jQuery v3.3.1-->
    <script type="text/javascript" src="{{ asset('public/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <!-- Menu -->
    <link rel="stylesheet" href="{{ asset('public/assets/menu-mobile/menu-mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/flat-menu/prefixfree.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/animate.css/animate.min.css') }}">
    <!-- Slick-carousel-->
    <link rel="stylesheet" href="{{ asset('public/node_modules/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/node_modules/slick-carousel/slick/slick-theme.css') }}">
    <!-- Hover.css -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/hover.css/css/hover-min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/toastr/build/toastr.css') }}">
    <!-- Superfish -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/node_modules/superfish/dist/css/superfish.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/node_modules/superfish/dist/css/superfish-vertical.css') }}"/>
    <!-- ihover -->
    <link rel="stylesheet" href="{{ asset('public/assets/ihover/src/ihover.css') }}"/>

    {{--owl--}}
    <link rel="stylesheet" href="{{ asset('public/node_modules/owl.carousel2/dist/assets/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/node_modules/owl.carousel2/dist/assets/owl.theme.default.min.css') }}"/>
    <!-- Main -->
    <link rel="stylesheet" href="{{ asset('public/css/plugin-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style_dev.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/widgets.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/widget.css') }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/images/finpageicon-5734_40x40.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/finpageicon-5734_40x40.png') }}">
    <link rel="manifest" href="{{ asset('public/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('public/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=vietnamese"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700&amp;subset=vietnamese" rel="stylesheet">
    <style type="text/css">
        {!! @$data['header_css'] !!}
    </style>
    {!! @$data['header_link'] !!}
    @yield('css')
    <script type="text/javascript" src="{{ asset('public/js/default/code.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/default/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/default/function.js') }}"></script>
</head>
<body>
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
</script>
<div id="loading" style="display:none">
    <img src="{{ asset('public/images/ajax-loading.gif')}}" alt="Loading..."/>
</div>
@yield('header')
@yield('slider')

<div class="main">
    <div class="container pt-3">
        <div class="row">
            @yield('all')
        </div>
        <div class="row">
            @yield('left-content')
            @yield('content')
        </div>
    </div>
</div>
@yield('info')

{{-- Plugins --}}
@if(isset($data))
    @foreach($data['plugins'] as $key => $value)
        @if($value['enable'])
            @include(getView('plugins.' . $key))
        @endif
    @endforeach
@endif
    {{--@include(getView('master.widget_area'), ['position' => 'footer'])--}}
@yield('footer')
<script type="text/javascript">var site_path = '{{ url('') }}';</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('public/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Wowjs -->
<script type="text/javascript" src="{{ asset('public/node_modules/wowjs/dist/wow.min.js') }}"></script>
<!-- Menu -->
<script type="text/javascript" src="{{ asset('public/assets/menu-mobile/menu-mobile.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/flat-menu/prefixfree.min.js') }}"></script>
<!-- Sweetalert 2.1.0 -->
<script type="text/javascript" src="{{ asset('public/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<!-- Slick-carousel -->
{{--<script type="text/javascript" src="{{ asset('public/node_modules/slick-carousel/slick/slick.min.js') }}"></script>--}}
<script type="text/javascript"
        src="{{ asset('public/node_modules/@zeitiger/elevatezoom/jquery.elevateZoom-3.0.8.min.js') }}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
<!-- Superfish -->
<script type="text/javascript" src="{{ asset('public/node_modules/superfish/dist/js/superfish.min.js') }}"></script>
<script src="{{ asset('public/node_modules/owl.carousel2/dist/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        new WOW().init();

        $('ul.sf-menu').superfish({
            animation: {height: 'show'},
            delay: 100,
        });
    });
</script>
<script type="text/javascript">
    {!! @$data['header_script'] !!}
</script>
@yield('javascript')


<a href="tel:0938187496" class="d-none d-md-block">
    <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon">
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle"></div>
    </div>
</a>

<a class="d-none  d-md-block" href="https://zalo.me/0938187496" target="blank">
    <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show zalo-phone" id="coccoc-alo-phoneIcon">
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle"></div>
    </div>
</a>
</body>
</html>
