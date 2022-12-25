<title>@yield('title')</title>

<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  @if(LaravelLocalization::getCurrentLocale() == 'ar')

  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/css/adminlte.rtl.css') }}">


  @else
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/css/adminlte.min.css') }}">
  @endif

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/assets/plugins/summernote/summernote-bs4.min.css') }}">
  @yield('css')
