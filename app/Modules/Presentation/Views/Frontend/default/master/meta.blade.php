    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @$meta->title }}</title>
    <meta name="keywords" content="{{ @$meta->meta_keywords }}">
    <meta name="description" content="{{ @$meta->meta_description }}">
    <meta name="robots" content="{{ @$meta->meta_robots }}">
    @if (!empty($meta->meta_extension))
    @foreach($meta->meta_extension as $key => $value)
        <meta name="{{ $key }}" content="{{ $value }}">
    @endforeach
    @endif
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ @$meta->title }}" />
    <meta property="og:description" content="{{ @$meta->meta_description }}" />
    <!--<meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />-->
