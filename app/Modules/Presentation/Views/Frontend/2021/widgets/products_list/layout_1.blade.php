<div class="row " id="slick-{{ $cat_id }}">
    @if(!empty($data))
        @foreach($data as $content)
            {{--<div class="col-6 col-md-{{ 12 / $wid_info['params']->columns }}">--}}
            <div class="col-6 col-md-6 col-lg-3">
                <div class="product-main mt-2 bg-white rounded">
                    <div class="card h-100">
                        <a href="{{ route('FrontendProduct', $content['alias']) }}">
                            @if($wid_info['params']->showImage)
                                <img width="100%" class="card-img-top"
                                     src="{{ getThumbImage($content['images'][0], 'define.folder.products_thumb') }}"
                                     alt="{{ $content['title'] }}">
                            @endif
                        </a>

                    <div class="card-body">
                        @if($wid_info['params']->showTitle)
                            <div class="name_sanpham">
                                <header>
                                    <h2 class="font-size-1 pt-3">
                                        <a class="color-black" title="{{ $content['title'] }}"
                                           href="{{ route('FrontendProduct', $content['alias']) }}">{{ $content['title'] }}</a>
                                    </h2>
                                </header>
                            </div>
                            @if($content['price_contact'])
                                <span class="color-red">Liên hệ</span>
                            @else

                                <div class="row no-gutters ">
                                    <div class="col-md-12 col-lg-6 text-center">
                                        <strong class="color-red">{{ number_format($content->price) }} ₫</strong>
                                        <strong class="price-old">
                                            @if($content->price_compare)
                                            {{ number_format($content->price_compare) }} ₫
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="col-md-12 col-lg-6 text-center">
                                        <a class="dathang_sp add_cart" rel="46" data-id="{{$content->id}}" data-coco="addCart">Đặt Hàng</a>
                                    </div>
                                </div>

                            @endif
                        @endif
                        @if($wid_info['params']->showIntro)
                            <p>
                                {{ str_limit($content['introtext'], $wid_info['params']->subIntro) }}
                            </p>
                        @endif
                    </div>
                    </div>
                </div>
                {{--@php(var_dump($data->links()))--}}

            {{--@if (!is_null($content->list->links()))--}}

                {{--@endif--}}
            </div>
        @endforeach

    @endif
</div>

<div class="text-center mt-4 div-pagination d-none" id="pagination-{{ $cat_id }}" cat-id="{{ $cat_id}}" >
    {{ $data->links(getView('layouts.pagination')) }}
</div>


@if(isset($wid_info['params']->slider) && $wid_info['params']->slider == 1)
    <script>
        $(document).ready(function () {



            {{--$('.page-link').attr('data-url', "{{ route('ApiGetListProductByPageAndCategory')}}");--}}
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

            // Add product to cart




        });
    </script>
@endif
