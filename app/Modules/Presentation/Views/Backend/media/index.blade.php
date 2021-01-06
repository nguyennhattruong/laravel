@extends('Backend::layouts.master')
@section('content')
    <div class="header sticky-top">
        <h4><i class="fa fa-file-text-o"></i> Media
        </h4>
    </div>
    <div class="card">
        <iframe width="100%" height="500px"
                src="{{ url('public/plugins/filemanager/dialog.php?type=1&akey=f082bb76e751504cec75782056627a84&langCode=vi') }}"
                frameborder="0"></iframe>
    </div>
@endsection
