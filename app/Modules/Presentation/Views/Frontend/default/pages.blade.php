@extends(getView('master.master'))
@section('content')
    <section>
        @if(!empty($data))
            {!! $data->content !!}
        @endif
    </section>
@endsection
