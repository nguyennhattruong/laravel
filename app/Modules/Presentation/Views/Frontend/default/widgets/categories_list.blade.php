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
    <ul class="sf-menu sf-vertical">{!! $data !!}</ul>
    <div class="clearfix"></div>
@overwrite
