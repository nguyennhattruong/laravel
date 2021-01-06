@extends(
    getView('layouts.' . $wid_content['layout']),
    [
        'layout' => [
            'wid' => $wid_content,
            'link' => route('SiteCategory', $data['category_alias'])
        ]
    ]
)
@section('wid_content')
    @include(getView('widgets.content_list.layout_' . $wid_content['params']->template), ['data' => $data['list'], 'wid_info' => $wid_content])
@overwrite
