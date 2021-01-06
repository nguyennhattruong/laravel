@extends(getView('master.master'))
@section('content')
    <section class="bg-white">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb row">
                    <li class="breadcrumb-item">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    @foreach($cate as $item)
                        <li class="breadcrumb-item">
                            <a href="{{ route('SiteCategory', $item->alias) }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </section>
    <section class="container py-2">
        <div class="row">
            @if(!empty($data))
                <div class="col-md-9 mb-4">
                    <div class="card border-0">
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
                            @include(getView('layouts.social'))
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include(getView('master.widget_area'), ['position' => 'content_page'])
                </div>
            @endif
        </div>
    </section>
@endsection
