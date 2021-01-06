@if(isset($data['header_title']))
    @php
        $wid_content['title'] = str_replace('{name}', '<span class="color-orange">' . $data['header_title'] . '</span>', $wid_content['title'])
    @endphp
@endif

@extends(
    getView('layouts.' . $wid_content['layout']),
    [
        'layout' => [
            'wid' => $wid_content,
            'link' => route('FrontApartment', $data['apartment_type_alias'])
        ]
    ]
)
@section('wid_content')
    @include(getView('widgets.apartment_list.layout_' . $wid_content['params']->template), ['data' => $data['list'], 'wid_info' => $wid_content])
@overwrite
