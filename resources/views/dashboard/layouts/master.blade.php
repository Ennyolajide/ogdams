<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>@yield('title') | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="\bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="\bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="\bower_components/Ionicons/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="\bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="\dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="\dist/css/skins/_all-skins.min.css">
        <!-- Custom style -->
        <link rel="stylesheet" href="\css/style.css">
        <!-- Animate style -->
        <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css"/>
        <!-- Additional css -->
        @yield('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
                href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        {{--  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> --}}

        <!-- Custom styles -->
        @yield('style')

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include('dashboard.layouts.sidebar')

            @include('dashboard.layouts.header')



            <!-- Content Wrapper. fContains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @yield('content-header')
                @include('dashboard.layouts.loader')

                <!-- Main content -->
                @yield('content')
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->

            @include('dashboard.layouts.footer')

            <!-- Notifier -->
            {{-- simple modal without header and footer to display response form server to client --}}
            @include('dashboard.layouts.notifier')
            <!-- /.Notifier -->

            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="\bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="\bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="\bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="\dist/js/adminlte.min.js"></script>
        <!-- Notify -->
        @if( session('notification'))
            <script>
                $('#notification-modal').modal('show');
            </script>
        @endif
        @if( session('modal'))
            <script>
                $('#response-modal').modal('show');
            </script>
        @endif

        @yield('scripts')
    </body>
</html>
