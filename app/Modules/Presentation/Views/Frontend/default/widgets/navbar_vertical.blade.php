@extends(getView('layouts.' . $wid_content['layout']), ['layout' => ['wid' => $wid_content, 'link' => $wid_content['link']]])
@section('wid_content')
        {!! $data !!}
@overwrite
