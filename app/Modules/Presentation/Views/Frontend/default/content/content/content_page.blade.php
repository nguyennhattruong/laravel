@extends(getView('master.master_page'))

@section('header')
    <header class="duration header sticky-top">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    @if(isset($data->layout->header_left))
                        @include(getView('master.widget_single'), ['id' => $data->layout->header_left])
                    @endif
                </div>
                <div class="col-10 my-2">
                    @if(isset($data->layout->header_right))
                        @include(getView('master.widget_single'), ['id' => $data->layout->header_right])
                    @endif
                    <div class="text-right d-block d-md-none mt-2">
                        <span class="cur-pointer font-size-2 text-change" data-coco="menu">
                            <i aria-hidden="true" class="fa fa-bars"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <section class="container py-2">
        <div class="row">
            @if(!empty($data))
                <div class="col-md-9 mb-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <article class="article">
                                <header>
                                    <h1 class="mb-4">{{ $data->title }}</h1>
                                </header>
                                <div class="article-intro mb-4">
                                    <blockquote class="blockquote">
                                        <p class="mb-0">
                                            <i class="fa fa-quote-left"></i> {{ $data->introtext }}
                                            <i class="fa fa-quote-right"></i></p>
                                    </blockquote>
                                </div>
                                <div class="article-body">{!! $data->fulltext !!}</div>
                            </article>
                            <!-- BEGIN: Social Network -->
                            <div class="mt-4">
                                <div class="pull-left">
                                    <div id="fb-root"></div>
                                    <script>(function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-like"
                                         data-href="{{ 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] }}"
                                         data-layout="button" data-action="like" data-show-faces="true"
                                         data-share="true"></div>
                                </div>
                                <div class="pull-left" style="margin:3px">
                                    <script src="https://apis.google.com/js/platform.js" async defer>
                                        {
                                            lang: 'vi'
                                        }
                                    </script>
                                    <div class="g-plusone" data-size="medium" data-annotation="none"></div>
                                </div>
                            </div>
                            <!-- END: Social Network -->
                            <div class="clearfix"></div>
                            <!-- Comment -->
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div width="100%" class="fb-comments"
                                 data-href="{{ 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] }}"
                                 data-numposts="5"></div>
                            <!-- END: Comment-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include(getView('master.widget_area'), ['position' => 'right'])
                    @include(getView('master.widget_area'), ['position' => 'content_page'])
                </div>
            @endif
        </div>
    </section>
@endsection
