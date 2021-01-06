@extends(getView('master.master'))
@section('content')
    <div class="col-md-9 mb-4">
        <div class="title_main"><span>Giới thiệu</span></div>

    @if(!empty($data))
            {!! $data->content !!}
        @endif
    </div>
@endsection
