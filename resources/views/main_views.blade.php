<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Diet Expert</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/bootstrap.min.css') }}">
        <!-- Ionicons Fonts Css -->
         <link rel="stylesheet" href="{{ asset('assets/front-end/css/styles2.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/front-end/css/ionicons.min.css') }}">
        <!-- animate css -->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/animate.css') }}">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/slider.css') }}">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/jquery.fancybox.css') }}">
        <!-- template main css file -->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/main.css') }}">
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('assets/front-end/css/responsive.css') }}">

        <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="{{ asset('assets/front-end/js/vendor/modernizr-2.6.2.min.js') }}"></script>
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- owl carouserl js -->
        <script src="{{ asset('assets/front-end/js/owl.carousel.min.js') }}"></script>
        <!-- bootstrap js -->

        <script src="{{ asset('assets/front-end/js/bootstrap.min.js') }}"></script>
        <!-- wow js -->
        <script src="{{ asset('assets/front-end/js/wow.min.js') }}"></script>
        <!-- slider js -->
        <script src="{{ asset('assets/front-end/js/slider.js') }}"></script>
        <script src="{{ asset('assets/front-end/js/jquery.fancybox.js') }}"></script>
        <!-- template main js -->
        <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
    </head>
    <body>



    @include('header')

    @yield('content')

    @include('footer')

       </body>

       </html>
