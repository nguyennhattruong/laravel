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
{{--                    <li class="breadcrumb-item active" aria-current="page">{{ $info['title'] }}</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--            <div class="col-md-3">--}}
{{--                @include(getView('master.widget_area'), ['position' => 'category_page'])--}}
{{--            </div>--}}
            <div class="col-md-9">
                <header>
                    <h2 class="title_main">
                        {{$info['title'] }}
                    </h2>
                </header>
                @if(!empty($data->total()))

                    @foreach($data as $content)
                        <div class="card card-default mb-3">
                            <div class="card-body">
                                <div class="media">
                                    <a href="{{ route('SiteContent', $content['alias']) }}">
                                        <img width="100%" style="max-width: 180px"
                                             src="{{ getThumbImage($content['image'], 'define.folder.content_thumb') }}"
                                             alt="{{ $content['title'] }}"
                                             class="mr-3">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mt-0">
                                            <a class="news" href="{{ route('SiteContent', $content['alias']) }}">{{ $content['title'] }}</a>
                                        </h5>
                                        {{ str_limit($content['introtext'], 200) }}
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <a class="pull-right text-danger f-right" href="{{ route('SiteContent', $content['alias']) }}">
                                    Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @else
                    <div class="text-center text-danger">
                        <p>Nội dung chưa cập nhật. Xin vui lòng xem chuyên mục khác.</p>
                    </div>
                @endif
            </div>
        <div class="text-center">{{ $data->links(getView('layouts.pagination')) }}</div>
@endsection
