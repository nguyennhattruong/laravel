<div class="row" id="slick-{{ $wid_info['id'] }}">
    @if(!empty($data))
        @foreach($data as $content)
            <article
                    class="col-sm-12 col-lg-{{ 12 / $wid_info['params']->columns }} @if ($wid_info['params']->columns > 1){{ 'articles_many_cols' }} @endif">
                <div class="p-2 border bg-white rounded">
                    <div>
                        <a href="{{ route('SiteContent', $content['alias']) }}">
                            @if($wid_info['params']->showImage)
                                <img width="100%"
                                     src="{{ getThumbImage($content['image'], 'define.folder.content_thumb') }}"
                                     alt="{{ $content['title'] }}">
                            @endif
                        </a>
                    </div>
                    <div>
                        @if($wid_info['params']->showTitle)
                            <header>
                                <h3 class="font-size-1d2 pt-3">
                                    <a class="color-black"
                                       href="{{ route('SiteContent', $content['alias']) }}">{{ $content['title'] }}</a>
                                </h3>
                            </header>
                        @endif
                        @if($wid_info['params']->showIntro)
                            <p>
                                {{ str_limit($content['introtext'], $wid_info['params']->subIntro) }}
                            </p>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    @endif
</div>
@if(isset($wid_info['params']->slider) && $wid_info['params']->slider == 1)
    <script>
        $(document).ready(function () {
            var count = '{{ count($data) }}';
            if (count > colProduct) {
                $('#slick-{{ $wid_info["id"] }}').not('.slick-initialized').slick({
                    slidesToShow: colProduct,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                    autoplay: true,
                });
            }
        });
    </script>
@endif
