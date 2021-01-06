@extends(getView('master.master'))
@section('content')
    <section class="bg-white mb-5">
        <div class="overlay overlay-black">
            <img width="100%" src="{{ asset('public/themes/novaland/images/bg.jpg') }}">
            <div class="position-absolute-center" style="top:-50px">
                <div>
                    <nav class="d-inline-flex">
                        <ol class="breadcrumb row mb-0 border-0 font-size-1d2">
                            <li class="breadcrumb-item">
                                <a class="color-white font-play" href="{{ url('') }}">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item color-white font-play">
                                Dự án
                            </li>
                        </ol>
                    </nav>
                    <div class="display-4 font-play color-white">Dự án</div>
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row">
            @foreach($list as $location)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 overlay overlay-hover-0 overlay-black-35 img-hover-zoom h-100">
                        <img src="{{ getThumbImage($location->image, 'define.folder.apartment_locations_thumb') }}"
                             class="card-img-top" alt="{{ $location->name }}">
                        <div class="position-absolute-center">
                            <a style="width: 100%" href="{{ route('FrontApartmentLocationsDetail', $location->alias) }}" class="color-white">
                                <h3 class="text-uppercase">{{ $location->name }}</h3>
                                <p>{!! $location->description  !!}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center my-5">{{ $list->links(getView('layouts.pagination')) }}</div>
    </section>
@endsection
