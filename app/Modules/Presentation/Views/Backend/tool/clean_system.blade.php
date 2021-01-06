@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-trash-o"></i> Clean System</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <script>
                $(document).ready(function(){
                    $('.scrollbar-outer').scrollbar();
                });
            </script>
            @php $class = 'badge-success' @endphp
            @if($data['count'] > 0)
                @php $class = 'badge-danger' @endphp
                <div class="scrollbar-outer mb-2" style="max-height: 200px">
                    @foreach($data['files'] as $file)
                        {{ $file }}<br>
                    @endforeach
                </div>
            @endif
            <p>
                Tổng số file: <span class="badge {{$class}}">{{ $data['count'] }}</span><br>
                Dung lượng: <span class="badge {{$class}}">{{ $data['value'] }}</span>
            </p>
            {!! form($form, $formOptions = ['method' => 'POST']) !!}
        </div>
    </div>
@endsection
