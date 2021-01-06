<div class="row">
    @if(!empty($data))
        @foreach($data as $content)
            <article
                    class="articles col-md-{{ 12 / $wid_info['params']->columns }} @if ($wid_info['params']->columns > 1){{ 'articles_many_cols' }} @endif">
                <div class="articles_card">
                    <div class="articles_img">
                        <a href="{{ route('SiteContent', $content['alias']) }}">
                            @if($wid_info['params']->showImage)
                                <img src="{{ getThumbImage($content['image'], 'define.folder.content') }}"
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
                </div>
            </article>
        @endforeach
    @endif
</div>
