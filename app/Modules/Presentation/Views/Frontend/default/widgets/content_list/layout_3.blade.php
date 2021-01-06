<div id="slick-{{ $wid_info['id'] }}" class="row">
    @if(!empty($data))
        @foreach($data as $content)
            <article
                    class="articles col-sm-12 col-lg-{{ 12 / $wid_info['params']->columns }} @if ($wid_info['params']->columns > 1){{ 'articles_many_cols' }} @endif">
                <div class="articles_card">
                    <div class="articles_img_responsive">
                        <a href="{{ route('SiteContent', $content['alias']) }}">
                            @if($wid_info['params']->showImage)
                                <img src="{{ getThumbImage($content['image'], 'define.folder.content_thumb') }}"
                                     alt="{{ $content['title'] }}">
                            @endif
                        </a>
                    </div>
                    @if($wid_info['params']->showTitle)
                        <header>
                            <h3>
                                <a href="{{ route('SiteContent', $content['alias']) }}">{{ $content['title'] }}</a>
                            </h3>
                        </header>
                    @endif
                    @if($wid_info['params']->showIntro)
                        <p>
                            {{ str_limit($content['introtext'], $wid_info['params']->subIntro) }}
                        </p>
                    @endif
                    <div class="articles-price-tag">{{ @$content->attribs->price }}</div>
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
