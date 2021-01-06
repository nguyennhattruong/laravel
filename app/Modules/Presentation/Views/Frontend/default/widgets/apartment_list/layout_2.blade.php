<div class="row" id="slick-{{ $wid_info['id'] }}">
    @if(!empty($data))
        <ul class="list-unstyled px-4 mb-0">
            @foreach($data as $content)
                <li class="media pb-3 mb-3" style="border-bottom: 1px dashed #ddd">
                    <a href="{{ route('FrontApartment', $content->alias) }}">
                        <img width="100" height="80" class="rounded mr-3"
                             src="{{ getThumbImage($content['images'][0], 'define.folder.apartment') }}"
                             alt="{{ $content->name }}">
                    </a>
                    <div class="media-body">
                        <h5 class="mt-0 mb-1 font-size-1d1"><a
                                    href="{{ route('FrontApartment', $content->alias) }}">{{ $content->name }}</a></h5>
                        <span class="color-light-green"><small>{{ number_format($content->price, 0, '.', '.') }}
                                <u>đ</u></small></span>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
