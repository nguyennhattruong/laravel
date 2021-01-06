@extends(getView('master.master'))
@section('content')
    <section>
        @include(getView('master.widget_area'), ['position' => 'body'])
    </section>
@endsection
