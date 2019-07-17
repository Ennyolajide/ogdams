<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="\css/bootstrap/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="\plugins/font-awesome/css/font-awesome.min.css">
        <!-- NProgress -->
        <link href="\plugins/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="\css/animate.min.css" rel="stylesheet">

        <!-- Theme style -->
        <link href="\css/custom.min.css" rel="stylesheet">


    </head>

    <body class="login">

        @yield('content')

        @yield('scripts')
    </body>
</html>
