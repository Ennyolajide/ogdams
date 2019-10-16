<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title') | Dashboard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="_token" content="{{ csrf_token() }}" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicons -->
        <link rel="shortcut icon" href="\favicon.ico" type="image/x-icon">
        <link rel="icon" href="\favicon.ico" type="image/x-icon">
        <meta name="msapplication-TileColor" content="#1ABB9C">
        <meta name="theme-color" content="#1ABB9C">

        <link rel="icon" href="\favicon.ico" type="image/ico"/>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="\css/bootstrap/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="\plugins/font-awesome/css/font-awesome.min.css">
        <!-- NProgress -->
        <!--link href="\plugins/nprogress/nprogress.css" rel="stylesheet"-->
        <!-- Animate.css -->
        <link href="\css/animate.min.css" rel="stylesheet">

        <!-- Theme style -->
        <link href="\css/custom.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="\css/style.css" rel="stylesheet">
        <!-- Google Font -->
        <link rel="stylesheet"
                href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- Additional css -->
        @yield('css')
        <!-- Custom styles -->
        @yield('style')
        <style>
            /* body{
                font-size: 15px;
            } */
        </style>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src="{{ config('constants.livechat.tawk') }}";
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('dashboard.layouts.sidebar')
                @include('dashboard.layouts.header')


                <!-- page content -->
                 <div class="right_col" role="main">
                     <!-- Content Header (Page header) -->
                    @yield('content-header')
                    <!-- loader-->
                    @include('dashboard.layouts.loader')
                    <!-- Main content -->
                    @yield('content')
                    <!-- /.content  -->


                 </div>
                @include('dashboard.layouts.footer')

                <!-- Notifier -->
                {{-- simple modal without header and footer to display response form server to client --}}
                @include('dashboard.layouts.notifier')
                <!-- /.Notifier -->

            </div>
        </div>


        <!-- jQuery -->
        <script src="\js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="\js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="\js/fastclick.js"></script>
        <!-- NProgress -->
        <!--script src="\plugins/nprogress/nprogress.js"></script-->
        <!-- Custom Theme Scripts -->
        <script src="\js/custom.min.js"></script>
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
