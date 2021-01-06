@extends(getView('master.master'))
@section('content')
    <section class="bg-white border-bottom" style="border-bottom-color: rgba(0,0,0,.07)!important;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb row mb-0 border-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('FrontApartmentLocationsList') }}">Dự án</a>
                    </li>
                    <li class="breadcrumb-item">
                        {{ $data->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="overlay overlay-black"
             style="height: 300px; background: url('{{ getThumbImage($data->image, 'define.folder.apartment_locations') }}') no-repeat center center; background-size: cover;">
        <div class="position-absolute-center">
            <h1 class="display-4 font-play color-white">{{ $data->name }}</h1>
        </div>
    </section>
    <section class="bg-white">
        <section class="container py-5">
            @if(!empty($data))
                <div class="">
                    <div class="">
                        <article id="lightgallery" class="font-play">
                            <section class="font-size-1d1 color-black">
                                <!-- TONG QUAN -->
                                <div class="row align-items-center pb-5">
                                    <div class="col-md-6">
                                        <h2 class="text-uppercase">
                                            TỔNG QUAN <span class="color-light-green">{{ $data->name }}</span>
                                        </h2>
                                        <div>{!! $data->content->overviewContent !!}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="zoom" href="{{ $data->content->overviewImage }}">
                                            <img src="{{ $data->content->overviewImage }}" style="width: 100%;">
                                        </a>
                                    </div>
                                </div>
                                <!-- VI TRI -->
                                <div class="row align-items-center pt-5">
                                    <div class="col-md-6">
                                        <a class="zoom" href="{{ $data->content->positionImage }}">
                                            <img src="{{ $data->content->positionImage }}" style="width: 100%;">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="text-uppercase">
                                            VỊ TRÍ <span class="color-light-green">{{ $data->name }}</span>
                                        </h2>
                                        <div>{!! $data->content->positionContent !!}</div>
                                    </div>
                                </div>
                                <!-- TIEN ICH -->
                                @if($data->content->utilityShow)
                                    <div class="my-5">
                                        <div class="container p-md-5">
                                            <h2 class="text-center mb-4">MẶT BẰNG THIẾT KẾ - TIỆN ÍCH CĂN HỘ</h2>
                                            <div>
                                                <ul class="light-slider">
                                                    @foreach($data->content->utilityImage as $utilityImg)
                                                        <li data-thumb="{{ $utilityImg }}">
                                                            <a class="zoom" href="{{ $utilityImg }}">
                                                                <img width="100%" src="{{ $utilityImg }}">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!-- HINH ANH -->
                                <div class="bg-white py-4">
                                    <div class="container">
                                        <h2 class="text-uppercase text-center mb-4">
                                            HÌNH ẢNH CĂN HỘ <span class="color-light-green">{{ $data->name }}</span>
                                        </h2>
                                        @if($data->content->oneShow)
                                            <div>
                                                <h3 class="text-center mb-4 color-light-green">CĂN 1 PHÒNG NGỦ</h3>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <ul class="light-slider">
                                                            @foreach($data->content->oneImage as $oneImg)
                                                                <li data-thumb="{{ $oneImg }}">
                                                                    <a class="zoom" href="{{ $oneImg }}">
                                                                        <img width="100%" src="{{ $oneImg }}">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $data->content->oneContent !!}
                                                        <div class="circle-waves-animation">
                                                            <div class="svg-box"
                                                                 data-toggle="modal"
                                                                 data-target="#exampleModal">
                                                            <span style="color: #28a745;font-size: 14px;padding:0 5px;">
                                                                <strong>NHẬN THÔNG TIN CHI TIẾT</strong>
                                                            </span>
                                                            </div>
                                                            <div class="circle delay1">&nbsp;</div>
                                                            <div class="circle delay2">&nbsp;</div>
                                                            <div class="circle delay3">&nbsp;</div>
                                                            <div class="circle delay4">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($data->content->twoShow)
                                            <div>
                                                <h3 class="text-center mb-4 color-light-green">CĂN 2 PHÒNG NGỦ</h3>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <ul class="light-slider">
                                                            @foreach($data->content->twoImage as $twoImg)
                                                                <li data-thumb="{{ $twoImg }}">
                                                                    <a class="zoom" href="{{ $twoImg }}">
                                                                        <img width="100%" src="{{ $twoImg }}">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $data->content->twoContent !!}
                                                        <div class="circle-waves-animation">
                                                            <div class="svg-box"
                                                                 data-toggle="modal"
                                                                 data-target="#exampleModal">
                                                            <span style="color: #28a745;font-size: 14px;padding:0 5px;">
                                                                <strong>NHẬN THÔNG TIN CHI TIẾT</strong>
                                                            </span>
                                                            </div>
                                                            <div class="circle delay1">&nbsp;</div>
                                                            <div class="circle delay2">&nbsp;</div>
                                                            <div class="circle delay3">&nbsp;</div>
                                                            <div class="circle delay4">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($data->content->threeShow)
                                            <div>
                                                <h3 class="text-center mb-4 color-light-green">CĂN 3 PHÒNG NGỦ</h3>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <ul class="light-slider">
                                                            @foreach($data->content->threeImage as $threeImg)
                                                                <li data-thumb="{{ $threeImg }}">
                                                                    <a class="zoom" href="{{ $threeImg }}">
                                                                        <img width="100%" src="{{ $threeImg }}">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $data->content->threeContent !!}
                                                        <div class="circle-waves-animation">
                                                            <div class="svg-box"
                                                                 data-toggle="modal"
                                                                 data-target="#exampleModal">
                                                            <span style="color: #28a745;font-size: 14px;padding:0 5px;">
                                                                <strong>NHẬN THÔNG TIN CHI TIẾT</strong>
                                                            </span>
                                                            </div>
                                                            <div class="circle delay1">&nbsp;</div>
                                                            <div class="circle delay2">&nbsp;</div>
                                                            <div class="circle delay3">&nbsp;</div>
                                                            <div class="circle delay4">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($data->content->officeShow)
                                            <div>
                                                <h3 class="text-center mb-4 color-light-green">OFFICE-TEL</h3>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <ul class="light-slider">
                                                            @foreach($data->content->officeImage as $officeImg)
                                                                <li data-thumb="{{ $officeImg }}">
                                                                    <a class="zoom" href="{{ $officeImg }}">
                                                                        <img width="100%" src="{{ $officeImg }}">
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! $data->content->officeContent !!}
                                                        <div class="circle-waves-animation">
                                                            <div class="svg-box"
                                                                 data-toggle="modal"
                                                                 data-target="#exampleModal">
                                                            <span style="color: #28a745;font-size: 14px;padding:0 5px;">
                                                                <strong>NHẬN THÔNG TIN CHI TIẾT</strong>
                                                            </span>
                                                            </div>
                                                            <div class="circle delay1">&nbsp;</div>
                                                            <div class="circle delay2">&nbsp;</div>
                                                            <div class="circle delay3">&nbsp;</div>
                                                            <div class="circle delay4">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                            <footer>
                                @include(getView('layouts.social'))
                            </footer>
                        </article>
                    </div>
                </div>
            @endif
        </section>
    </section>
    <section>
        @include(getView('master.widget_area'), ['position' => 'apartment_location_detail'])
    </section>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/node_modules/lightgallery/dist/css/lightgallery.min.css') }}"/>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/node_modules/lightslider/dist/css/lightslider.min.css') }}"/>
@endsection

@section('javascript')
    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('public/node_modules/lightgallery/dist/js/lightgallery.min.js') }}"></script>
    <!-- lightgallery plugins -->
    <script type="text/javascript"
            src="{{ asset('public/node_modules/lightgallery/modules/lg-thumbnail.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/node_modules/lightgallery/modules/lg-fullscreen.min.js') }}"></script>

    <!-- lightSlider -->
    <script type="text/javascript"
            src="{{ asset('public/node_modules/lightslider/dist/js/lightslider.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#lightgallery").lightGallery({
                selector: '.zoom'
            });

            $('.light-slider').lightSlider({
                gallery: true,
                item: 1,
                thumbItem: 5,
                slideMargin: 0,
                speed: 1000,
                pause: 3000,
                auto: true,
                loop: true,
                onSliderLoad: function () {
                    $('#lightSlider').removeClass('cS-hidden');
                }
            });
        });
    </script>
@endsection
