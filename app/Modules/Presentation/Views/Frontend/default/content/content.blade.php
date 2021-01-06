@if($data->layout_type == 1)
    @include(getView('content.content.content'), ['data' => $data])
@else
    @include(getView('content.content.content_page'), ['data' => $data])
@endif
