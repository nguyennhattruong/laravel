@if (Session::has('messageSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="color-green fa fa-check"></i> {!! Session::get('messageSuccess') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span>&times;</span>
        </button>
    </div>
@endif

@if (Session::has('messageError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! Session::get('messageError') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span>&times;</span>
        </button>
    </div>
@endif

@if (Session::has('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="m-0">
            @foreach(Session::get('errors')->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('messageWarning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {!! Session::get('messageWarning') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span>&times;</span>
        </button>
    </div>
@endif