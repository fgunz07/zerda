<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- lib css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lib/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">


    @yield('custom_css')

    <link rel="stylesheet" type="text/css" href="{{ asset('lib/dist/css/AdminLTE.min.css') }}">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-purple-light layout-top-nav">
    <!-- site wrapper -->
    <div class="wrapper">

        @include('apps.todolistApp.shared.nav')

        <div class="content-wrapper">

            <div class="container">

              <!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>
                  Boards
                  <small>Zerda 1.0</small>
                </h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Layout</a></li>
                </ol>
              </section>
              
              <section class="content">

                  @yield('content')

              </section>

            </div>
        
          </div>

        @include('apps.todolistApp.shared.footer')

    </div>

    <!-- lib scripts -->
    <script type="text/javascript" src="{{ asset('lib/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('lib/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('lib/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/message.js') }}"></script>

    <!-- CDN script's -->
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <!-- Script for modules -->
    @yield('custom_script')

</body>
</html>