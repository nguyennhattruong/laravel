@extends(getView('master.master'))
@section('content')
    <section class="bg-white">
        <div class="overlay overlay-black">
            <img src="{{ asset('public/themes/novaland/images/bg.jpg') }}">
            <div class="position-absolute-center" style="top:-50px">
                <div>
                    <nav class="d-inline-flex">
                        <ol class="breadcrumb row mb-0 border-0 font-size-1d2">
                            <li class="breadcrumb-item">
                                <a class="color-white font-play" href="{{ url('') }}">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item color-white font-play">
                                {{ $type->name }}
                            </li>
                        </ol>
                    </nav>
                    <div class="display-4 font-play color-white">{{ $type->name }}</div>
                </div>
            </div>
        </div>
    </section>
    <section class="container my-5">
        <div class="row">
            @if(!empty($list))
                <div class="col-md-9 mb-4">
                    <div class="row">
                        @foreach($list as $content)
                            <div class="col-sm-6 mb-4">
                                <div class="card h-100">
                                    <div class="img-hover-zoom">
                                        <a href="{{ route('FrontApartment', $content->alias) }}">
                                            <img src="{{ getThumbImage($content['images'][0], 'define.folder.apartment') }}"
                                                 class="card-img-top" alt="{{ $content->name }}">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('FrontApartment', $content->alias) }}">{{ $content->name }}</a>
                                        </h5>
                                        <span class="color-light-green font-weight-bold font-size-1d3">{{ number_format($content->price, 0, '.', '.') }}
                                            đ</span>
                                        <a class="btn bg-light-green color-white cur-pointer float-right">
                                            <i class="fas fa-exchange-alt mr-2"></i>So sánh
                                        </a>
                                    </div>
                                    <div class="card-footer">
                <span class="text-muted mr-3">
                    <i class="fas fa-bed mr-2 font-size-1d3"></i><small>{{ $content->bedroom }} Phòng ngủ</small>
                </span>
                                        <span class="text-muted border-left pl-3">
                    <i class="fas fa-bath mr-2 font-size-1d3"></i><small>{{ $content->bathroom }} Phòng tắm</small>
                </span>
                                    </div>
                                    <div class="position-absolute px-3 pt-2">
                                        <a href="{{ url('tim-kiem?label=' . $content->label_id) }}">
                                            @if(isset(\App\Modules\Domain\Models\Apartment::LABEL[$content->label_id]))
                                                <span class="badge badge-pill bg-success color-white px-3 py-2">
                                    {{ \App\Modules\Domain\Models\Apartment::LABEL[$content->label_id] }}
                                </span>
                                            @endif
                                        </a>
                                        <a href="{{ url('tim-kiem?state=' . $content->state) }}">
                                            @if(isset(\App\Modules\Domain\Models\Apartment::STATE[$content->state]))
                                                <span class="badge badge-pill bg-red color-white px-3 py-2">
                                    {{ \App\Modules\Domain\Models\Apartment::STATE[$content->state] }}
                                </span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">{{ $list->links(getView('layouts.pagination')) }}</div>
                </div>
                <div class="col-md-3">
                    @include(getView('master.widget_area'), ['position' => 'apartment_type'])
                </div>
            @endif
        </div>
    </section>
@endsection
