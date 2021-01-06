@extends(getView('master.master'))
@section('content')
            <div class="col-sm-12 col-md-12 col-lg-9">
                @include(getView('master.widget_area'), ['position' => 'body'])
            </div>
@endsection
