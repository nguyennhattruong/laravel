@extends(getView('master.master'))
@section('content')
{{--    <section class="bg-white">--}}
{{--        <div class="container">--}}
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb row">--}}
{{--                    <li class="breadcrumb-item">--}}
{{--                        <a class="color-black" href="{{ url('') }}">Trang chủ</a>--}}
{{--                    </li>--}}
{{--                    @foreach($cate as $item)--}}
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a href="{{ route('FrontendProductCategory', $item->alias) }}">{{ $item->title }}</a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </section>--}}
            @if(!empty($data))
                <div class="col-md-9 mb-4">
                    <section class="p-4 bg-white">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="zoom-left">
                                    <img id="zoom_09"
                                         src="{{ getThumbImage($data['images'][0], 'define.folder.products_thumb') }}"
                                         data-zoom-image="{{ getThumbImage($data['images'][0], 'define.folder.products') }}"
                                         width="100%" class="margin-bottom">
                                    <style>
                                        .ul {
                                            list-style-type: none;
                                            margin-top: 15px;
                                            padding-left: 0;
                                        }

                                        .ul li {
                                            display: inline-block;
                                            width: 20%;
                                            padding-right: 5px;
                                        }

                                        .ul img {
                                            width: 100%;
                                            transition-duration: .5s;
                                        }

                                        .ul img:hover {
                                            opacity: .75;
                                        }
                                    </style>
                                    <div>
                                        <ul class="ul" id="gallery_09">
                                            @foreach($data['images'] as $img)
                                                <li>
                                                    <a class="elevatezoom-gallery" data-update=""
                                                       data-image="{{ getThumbImage($img, 'define.folder.products') }}"
                                                       data-zoom-image="{{ getThumbImage($img, 'define.folder.products') }}">
                                                        <img src="{{ getThumbImage($img, 'define.folder.products_thumb') }}"></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#zoom_09").elevateZoom({
                                                gallery: "gallery_09",
                                                galleryActiveClass: "active"
                                            });

                                            $('#gallery_09').slick({
                                                slidesToShow: 4,
                                                slidesToScroll: 1,
                                                autoplaySpeed: 2746,
                                                dots: false,
                                                infinite: true,
                                                speed: 500,
                                                slide: 'li',
                                                cssEase: 'linear',
                                                autoplay: false
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-7 info_detail">
                                <header>
                                    <h1 class="item_info_detail name_detail color-black">{{ $data->title }}</h1>
                                </header>
                                <section>
                                    <p>
                                        <span>Mã:</span>
                                        <span>{{ $data->sku }}</span>
                                    </p>
                                    <p>
                                        <span>Giá:</span>
                                        <span class="font-bold color-red font-size-1d3">
                                            @if($data->price_contact)
                                                {{ 'Liên hệ' }}
                                            @else
                                                {{ number_format($data->price) }} ₫
                                            @endif
                                        </span>
                                    </p>
{{--                                    <div class="p-2 rounded mb-4"--}}
{{--                                         style="background-color: #efefef">{!! $data['description'] !!}</div>--}}
{{--                                    <p>--}}
                                        <a href="#" class="btn btn-success btn-lg" data-id="{{ $data->id }}"
                                           data-coco="addCart"><i class="fas fa-shopping-cart"></i>
                                            Thêm giỏ hàng</a>
                                    </p>
                                </section>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                           role="tab" aria-controls="home" aria-selected="true">Thông tin sản phẩm</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="py-4 tab-pane fade show active img-responsive" id="home"
                                         role="tabpanel"
                                         aria-labelledby="home-tab">
                                        {!! $data->content !!}
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-3">--}}
{{--                                <div class="card card-default border">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h2 class="text-uppercase font-roboto-condensed color-blue font-size-1d3 mb-4">--}}
{{--                                            Sản phẩm nổi bật</h2>--}}
{{--                                        <div>--}}
{{--                                            <ul class="list-unstyled">--}}
{{--                                                @foreach($relatedProducts as $product)--}}
{{--                                                    <li class="media">--}}
{{--                                                        <a href="{{ route('FrontendProduct', $product['alias']) }}"--}}
{{--                                                           class="mb-4">--}}
{{--                                                            <img width="80" height="auto" class="mr-3"--}}
{{--                                                                 src="{{ getThumbImage($product['images'][0], 'define.folder.products_thumb') }}">--}}
{{--                                                        </a>--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <a class="color-black"--}}
{{--                                                               href="{{ route('FrontendProduct', $product['alias']) }}">--}}
{{--                                                                <h3 class="font-size-1 mt-0">{{ $product['title'] }}</h3>--}}
{{--                                                            </a>--}}
{{--                                                            <span class="color-red font-size-1d1">--}}
{{--                                                        @if($product['price_contact'])--}}
{{--                                                                    {{ 'Liên hệ' }}--}}
{{--                                                                @else--}}
{{--                                                                    {{ number_format($product['price']) }} ₫--}}
{{--                                                                @endif--}}
{{--                                                    </span>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @include(getView('master.widget_area'), ['position' => 'right'])--}}
{{--                            </div>--}}
                        </div>
                        @include(getView('layouts.social'))
                    </section>
                    <section class="p-4 bg-white mt-4">
                        <h2 class="text-uppercase color-blue font-size-1d3 mb-4">Sản phẩm liên quan</h2>
                        <div class="owl-carousel owl-theme">
                                @foreach($relatedProducts as $product)
                                <div class="item col-md-3_owl">

                                <a href="{{ route('FrontendProduct', $product['alias']) }}" class="mb-4">
                                            <img src="{{ getThumbImage($product['images'][0], 'define.folder.products_thumb') }}">
                                            <h3 class="font-size-1 mt-2">{{ $product['title'] }}</h3>
                                            <div>
                                            <span class="color-red font-size-1d1">
                                                @if($product['price_contact'])
                                                    {{ 'Liên hệ' }}
                                                @else
                                                    {{ number_format($product['price']) }} ₫
                                                @endif
                                            </span>
                                            </div>
                                        </a>
                                </div>

                            @endforeach
                        </div>
                    </section>
                </div>
            @endif
@endsection
