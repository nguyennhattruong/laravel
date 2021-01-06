@extends(getView('master.master_home'))
@section('content')
    <section>
        @include(getView('master.widget_area'), ['position' => 'body'])
    </section>
@endsection
