@extends(getView('layouts.' . $wid_content['layout']), ['layout' => ['wid' => $wid_content, 'link' => $wid_content['link']]])
@section('wid_content')
    @if (!empty($data))
        <div class="{{ @$wid_content['params']->class }}">
            <div style="z-index: 5" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($data as $key => $image)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                            class="@if($key == 0) {{ 'active' }} @endif"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($data as $key => $image)
                        <div class="carousel-item @if($key == 0) {{ 'active' }} @endif">
                            <a target="_blank" href="{{ $image['link'] }}"><img class="d-block w-100" src="{{ $image['image'] }}"></a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endif
@overwrite
