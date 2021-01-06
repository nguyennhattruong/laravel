<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap v4.1.1 -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugin-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin/style.css') }}">

    <!-- Font Awesome 4.7.0 -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/font-awesome/css/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">

    <!-- Jquery Scrollbar -->
    <link rel="stylesheet" href="{{ asset('public/node_modules/jquery.scrollbar/jquery.scrollbar.css') }}">

    <!-- Bootstrap-Datepicker 1.7.1-->
    <link rel="stylesheet"
          href="{{ asset('public/node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Bootstrap Sweetalert 1.0.1 -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/node_modules/bootstrap-sweetalert/dist/sweetalert.css') }}"/>

    <script type="text/javascript" src="{{ asset('public/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">var site_path = '{{ url('') }}';</script>
    @yield('css')
</head>
<body>
<section>
    @yield('content')
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('public/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Bootstrap-Datepicker 1.7.1-->
<script type="text/javascript" src="{{ asset('public/node_modules/moment/min/moment.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('public/node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('public/node_modules/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Bootstrap Sweetalert 1.0.1 -->
<script type="text/javascript"
        src="{{ asset('public/node_modules/bootstrap-sweetalert/dist/sweetalert.js') }}"></script>

<!-- CKEditor 4 -->
<script type="text/javascript" src="{{ asset('public/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/admin/core.js') }}"></script>
@yield('javascript')
</body>
</html>
