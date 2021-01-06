@if(is_array($data))
    @foreach($data as $wid)
        @include(getView('widgets.' . $wid['widget']), ['wid_content' => $wid])
    @endforeach
@else
    @include(getView('widgets.' . $data['widget']), ['wid_content' => $data])
@endif
