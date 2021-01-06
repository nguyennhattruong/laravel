@extends(getView('master.master'))
@section('content')
    <section class="bg-white">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb row">
                    <li class="breadcrumb-item">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    @foreach($siblings as $item)
                        <li class="breadcrumb-item">
                            <a href="{{ route('SiteCategory', $item->alias) }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                    <li class="breadcrumb-item active" aria-current="page">{{ $category['title'] }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="container my-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">Danh mục</div>
                    <div class="card-body">
                        <ul class="sf-menu sf-vertical ">{!! $menu !!}</ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @if(!empty($data))
                        @foreach($data as $content)
                            <div class="col-sm-6 col-md-3 px-2">
                                <div class="product-main bg-white rounded">
                                    <div class="product-image">
                                        <a href="{{ route('FrontendProduct', $content['alias']) }}">
                                            <img width="100%"
                                                 src="{{ getThumbImage($content['images'][0], 'define.folder.products_thumb') }}"
                                                 alt="{{ $content['title'] }}">
                                        </a>
                                    </div>
                                    <div class="product-info pb-4">
                                        <header>
                                            <h3 class="font-size-1 pt-3">
                                                <a class="color-black"
                                                   href="{{ route('FrontendProduct', $content['alias']) }}">{{ $content['title'] }}</a>
                                            </h3>
                                        </header>
                                        @if($content['price_contact'])
                                            <span class="color-red font-size-1d2">Liên hệ</span>
                                        @else
                                            <span class="color-red font-size-1d2">{{ number_format($content->price) }}
                                                đ</span>
                                        @endif
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
        </div>
    </section>
@endsection
