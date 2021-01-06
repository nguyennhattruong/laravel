@if(isset($data))
    @foreach($data as $wid)
        @if ($wid['status'] == 1)
            @include(getView('widgets.' . $wid['widget']), ['wid_content' => $wid])
        @endif
    @endforeach
@endif
