@extends(getView('master.master'))
@section('content')
{{--    <section class="bg-white">--}}
{{--        <div class="container">--}}
{{--            <nav aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb row">--}}
{{--                    <li class="breadcrumb-item">--}}
{{--                        <a href="{{ url('') }}">Trang chủ</a>--}}
{{--                    </li>--}}
{{--                    @foreach($siblings as $item)--}}
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a href="{{ route('SiteCategory', $item->alias) }}">{{ $item->title }}</a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                    <li class="breadcrumb-item active" aria-current="page">{{ $category['title'] }}</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </section>--}}

<div class="col-md-9 mb-5">
    <header>
        <h2 class="title_main">
            {{$category['title'] }}
        </h2>
    </header>

    <div class="row">


        @if(!empty($data))
            @foreach($data as $content)


                <div class="col-sm-6 col-md-3 px-2">
                    <div class="product-main mt-2 bg-white rounded">
                        <div class="card h-100">
                            <a href="{{ route('FrontendProduct', $content['alias']) }}">
                                <img width="100%" class="card-img-top"
                                     src="{{ getThumbImage($content['images'][0], 'define.folder.products_thumb') }}"
                                     alt="{{ $content['title'] }}">
                            </a>
                            <div class="card-body">
                                <div class="name_sanpham">
                                    <header>
                                        <h2 class="font-size-1 pt-3">
                                            <a class="color-black" title="{{ $content['title'] }}"
                                               href="{{ route('FrontendProduct', $content['alias']) }}">{{ $content['title'] }}</a>
                                        </h2>
                                    </header>
                                    @if($content['price_contact'])
                                        <span class="color-red">Liên hệ</span>
                                    @else
                                        <div class="nd_sanpham">
                                            <div class="gia_sanpham">
                                                        <span class="color-red">{{ number_format($content->price) }}
                                                        đ</span>
                                            </div>
                                            <a class="dathang_sp add_cart" rel="46" data-id="{{$content->id}}" data-coco="addCart">Đặt Hàng</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            @endforeach
        @endif
    </div>
    <div class="text-center mt-4">
        {{ $data->links(getView('layouts.pagination')) }}
    </div>
</div>
{{--    <section class="container my-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card card-default">--}}
{{--                    <div class="card-header">Danh mục</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <ul class="sf-menu sf-vertical ">{!! $menu !!}</ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--                <div class="text-center mt-4">--}}
{{--                    {{ $data->links(getView('layouts.pagination')) }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--<script>--}}
{{--    $(document).ready(function () {--}}
        {{--var count = '{{ count($data) }}';--}}
        {{--var cols = '{{ $wid_info['params']->subIntro }}';--}}
        {{--if (count > cols) {--}}
        {{--    $('#slick-{{ $wid_info["id"] }}').slick({--}}
        {{--        slidesToShow: cols,--}}
        {{--        slidesToScroll: 1,--}}
        {{--        dots: true,--}}
        {{--        arrows: false,--}}
        {{--        autoplay: true,--}}
        {{--    });--}}
        {{--}--}}

{{--        // Add product to cart--}}
{{--        $("[data-coco=addCart]").click(function (e) {--}}
{{--            e.preventDefault();--}}

{{--            toastr.options = {--}}
{{--                "preventDuplicates": true,--}}
{{--                "timeOut": "3000",--}}
{{--            };--}}
{{--            toastr.success('Thêm vào giỏ hàng thành công!', 'Giỏ hàng');--}}

{{--            var id = $(this).data('id');--}}

{{--            // Call api--}}
{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: '{{ route('ApiProductAddCart') }}',--}}
{{--                data: {--}}
{{--                    'id': id,--}}
{{--                    'quantity': 1,--}}
{{--                },--}}
{{--                success: function (result) {--}}
{{--                    $('#quantity_cart').text(result);--}}
{{--                    // console.log(result);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}


{{--    });--}}
{{--</script>--}}
@endsection
