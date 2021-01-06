<ul class="list-unstyled p-2">
    @if(!empty($data))
        @foreach($data as $content)
            <li class="p-2">
                <a class="color-green" href="{{ route('SiteContent', $content['alias']) }}">{{ $content['title'] }}</a>
            </li>
        @endforeach
    @endif
</ul>
