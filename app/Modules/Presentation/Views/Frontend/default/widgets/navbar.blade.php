@extends(getView('layouts.' . $wid_content['layout']), ['layout' => ['wid' => $wid_content, 'link' => $wid_content['link']]])
@section('wid_content')
    @if($data)
        <nav class="{{ @$wid_content['params']->class }}">
            {!! $data['desktop'] !!}
        </nav>
        {!! $data['mobile'] !!}
    @endif
@overwrite
