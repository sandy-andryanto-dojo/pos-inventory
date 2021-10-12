<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ env('APP_NAME', 'Laravel') }} | @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="api-token" content={!! json_encode(Auth::guard("api")->tokenById(Auth::User()->id)) !!}>
        <meta name="base-url" content="{{ url('') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}">

        <!-- Other Plugins -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-toast/dist/jquery.toast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/datepicker3.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/cropper/cropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/cropper/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/stylesheets/app.core.css') }}?{{ time() }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/dist/img/app.png') }}"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('stylesheets')
    </head>
    <body class="hold-transition {{ CommonHelper::getTheme() }} sidebar-mini sidebar-collapse">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
               @include('layouts.main-header')
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
               @include('layouts.main-sidebar')
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
               @yield('content')
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="http://github.com/sandyandryantoo">Sandy Andryanto</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}"></script>

        <!-- Other Plugins -->
        <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-toast/dist/jquery.toast.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/cropper/cropper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/cropper/main.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>

        <!-- AdminLTE App -->
        @if(env('production'))
        <script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
        @else
        <script src="{{ asset('assets/dist/js/app.js') }}"></script>
        @endif
        <script src="{{ asset('assets/scripts/app.core.js') }}?{{ time() }}"></script>
        @yield('scripts')
    </body>
</html>
