@extends(
    getView('layouts.' . $wid_content['layout']),
    [
        'layout' => [
            'wid' => $wid_content,
            'link' => ''
        ]
    ]
)
@section('wid_content')
    <div class="row">
        @foreach($data['list'] as $location)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 overlay overlay-hover-0 overlay-black-35 img-hover-zoom h-100">
                    <img src="{{ getThumbImage($location->image, 'define.folder.apartment_locations_thumb') }}"
                         class="card-img-top" alt="{{ $location->name }}">
                    <div class="position-absolute-center">
                        <a style="width: 100%" href="{{ route('FrontApartmentLocationsDetail', $location->alias) }}" class="color-white">
                            <h3 class="text-uppercase">{{ $location->name }}</h3>
                            <p>{!! $location->description !!}</p>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@overwrite
