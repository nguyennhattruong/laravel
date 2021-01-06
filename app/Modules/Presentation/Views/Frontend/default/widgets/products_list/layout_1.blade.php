<div class="row" id="slick-{{ $wid_info['id'] }}">
    @if(!empty($data))
        @foreach($data as $content)
            <div class="col-6 col-md-{{ 12 / $wid_info['params']->columns }}">
                <div class="product-main bg-white rounded">
                    <div class="product-image">
                        <a href="{{ route('FrontendProduct', $content['alias']) }}">
                            @if($wid_info['params']->showImage)
                                <img width="100%"
                                     src="{{ getThumbImage($content['images'][0], 'define.folder.products_thumb') }}"
                                     alt="{{ $content['title'] }}">
                            @endif
                        </a>
                    </div>
                    <div class="product-info pb-1">
                        @if($wid_info['params']->showTitle)
                            <header>
                                <h3 class="font-size-1 pt-3">
                                    <a class="color-black"
                                       href="{{ route('FrontendProduct', $content['alias']) }}">{{ $content['title'] }}</a>
                                </h3>
                            </header>
                            @if($content['price_contact'])
                                <span class="color-red">Liên hệ</span>
                            @else
                                <span class="color-red font-size-1d2">{{ number_format($content->price) }} ₫</span>
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
        @endforeach
    @endif
</div>
@if(isset($wid_info['params']->slider) && $wid_info['params']->slider == 1)
    <script>
        $(document).ready(function () {
            var count = '{{ count($data) }}';
            var cols = '{{ $wid_info['params']->subIntro }}';
            if (count > cols) {
                $('#slick-{{ $wid_info["id"] }}').slick({
                    slidesToShow: cols,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                    autoplay: true,
                });
            }
        });
    </script>
@endif
