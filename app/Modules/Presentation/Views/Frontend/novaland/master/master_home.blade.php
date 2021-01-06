@extends('Frontend::system.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/themes/novaland/css/style.css') }}">
@endsection
@section('header')
    <header class="header" data-coco="scroll">
        <div class="fixed-top shadow-sm bg-white-alpha transition-duration-05" data-coco="scroll"
             data-addclass="bg-white"
             data-removeclass="bg-white-alpha">
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
                    <div class="col-lg-10 menu-white" data-coco="scroll" data-removeclass="menu-white">
                        @include(getView('master.widget_area'), ['position' => 'header_right'])
                    </div>
                    <a style="right:10px"
                       class="d-none d-lg-block position-absolute btn btn-success btn-lg btn mt-4 bg-light-green border-0 font-play"
                       href="tel:0938363989">
                        <i class="fas fa-phone-alt mr-2"></i><strong>0938 36 39 89</strong>
                    </a>
                    <a style="right:10px"
                       class="d-block d-lg-none position-absolute btn btn-success btn-small btn mt-4 bg-light-green border-0 font-play"
                       href="tel:0938363989">
                        <i class="fas fa-phone-alt mr-2"></i><strong>0938 36 39 89</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-5"></div>
        <div class="pt-5"></div>
        <div class="pt-5"></div>
        <div class="container py-5 text-center font-play">
            <div>
                <h2 class="display-4">
                    <span class="color-white">Tìm kiếm căn hộ</span>
                    <span class="color-light-green">Novaland</span>
                </h2>
                <div class="font-size-1d5 color-white text-uppercase">(Khu vực Tân Bình, Phú Nhuận)</div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="mt-5">
                        <form method="get" action="{{ route('FrontApartmentSearch') }}">
                            <div class="bg-white rounded" style="height: 60px">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select style="height: 60px"
                                                class="cur-pointer custom-select custom-select-lg border-0 bg-light-green rounded-left color-white"
                                                title="" name="type">
                                            <option value="" selected>Tất cả</option>
                                            @foreach($types as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input style="height: 60px" type="text" name="keyword"
                                           class="form-control form-control-lg rounded-0 border-0 ml-n1"
                                           title=""
                                           placeholder="Tiêu đề, địa chỉ ...">
                                    <div class="input-group-prepend p-2">
                                        <button data-toggle="collapse" data-target="#collapseExample" type="button"
                                                class="btn btn-light color-black rounded">
                                            <i class="fas fa-cog mr-md-1"></i>
                                            <span class="d-none d-md-inline-block">Nâng cao</span>
                                        </button>
                                    </div>
                                    <div class="input-group-prepend p-2">
                                        <button type="submit"
                                                class="btn btn-success text-uppercase border-0 rounded">
                                            <i class="fas fa-search mr-md-1"></i>
                                            <span class="d-none d-md-inline-block">Tìm kiếm</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseExample" class="collapse mt-n1">
                                <div class="bg-white font-size-1d1 border-top position-relative p-3 rounded-bottom input-group">
                                    <div class="dropdown mr-4">
                                        <span class="dropdown-toggle cur-pointer" id="dropdownLocation"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dự án
                                        </span>
                                        <div class="dropdown-menu pt-3 px-3" aria-labelledby="dropdownLocation">
                                            @foreach($locations as $locationKey => $locationValue)
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input name="location[]" type="checkbox"
                                                           class="custom-control-input"
                                                           value="{{ $locationKey }}"
                                                           id="customCheck{{ $locationKey }}" title="">
                                                    <label class="custom-control-label"
                                                           for="customCheck{{ $locationKey }}">{{ $locationValue }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="dropdown mr-4">
                                        <span class="dropdown-toggle cur-pointer" id="dropdownLocation"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Năm
                                        </span>
                                        <div class="dropdown-menu pt-3 px-3" aria-labelledby="dropdownLocation">
                                            <div class="mb-2">
                                                <input class="form-control mb-2" name="year[]" type="number" title=""
                                                       placeholder="Từ năm" min="0" max="2050">
                                                <input class="form-control" name="year[]" type="number" title=""
                                                       placeholder="Đến năm" min="0" max="2050">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown mr-4">
                                        <span class="dropdown-toggle cur-pointer" id="dropdownLocation"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Phòng tắm
                                        </span>
                                        <div class="dropdown-menu pt-3 px-3" aria-labelledby="dropdownLocation">
                                            <input class="form-control mb-2" name="bathroom" type="number" title="">
                                        </div>
                                    </div>
                                    <div class="dropdown mr-4">
                                        <span class="dropdown-toggle cur-pointer" id="dropdownLocation"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Phòng ngủ
                                        </span>
                                        <div class="dropdown-menu pt-3 px-3" aria-labelledby="dropdownLocation">
                                            <input class="form-control mb-2" name="bedroom" type="number" title="">
                                        </div>
                                    </div>
                                    <div class="dropdown mr-4">
                                        <span class="dropdown-toggle cur-pointer" id="dropdownLocation"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Diện tích
                                        </span>
                                        <div class="dropdown-menu pt-3 px-3" aria-labelledby="dropdownLocation">
                                            <div class="mb-2">
                                                <input class="form-control mb-2" name="land_size[]" min="50" max="200"
                                                       type="number" title=""
                                                       placeholder="Nhỏ nhất">
                                                <input class="form-control" name="land_size[]" min="50" max="200"
                                                       type="number" title=""
                                                       placeholder="Lớn nhất">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center color-white mt-5">
                <div class="font-size-1d3 mb-5">hoặc tìm theo loại căn hộ</div>
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('FrontApartmentType', 'can-ho-chuyen-nhuong') }}"
                           class="display-4 color-white py-5 mb-3 btn-block border border-dashed rounded bg-white-alpha hover hover-no-border hover-bg-light-green"><i
                                    class="far fa-building"></i></a>
                        <a href="{{ route('FrontApartmentType', 'can-ho-chuyen-nhuong') }}" class="color-white">Căn hộ
                            chuyển nhượng</a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('FrontApartmentType', 'can-ho-cho-thue') }}"
                           class="display-4 color-white py-5 mb-3 btn-block border border-dashed rounded bg-white-alpha hover hover-no-border hover-bg-light-green">
                            <i class="fas fa-city"></i></a>
                        <a href="{{ route('FrontApartmentType', 'can-ho-cho-thue') }}" class="color-white">Căn hộ cho
                            thuê</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-menu').click(function (e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
