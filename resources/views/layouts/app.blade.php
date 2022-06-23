<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title> POS | IGOU TELECOM</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Free Datta Able Admin Template come up with latest Bootstrap 4 framework with basic components, form elements and lots of pre-made layout options" />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template, free admin theme, free dashboard template"/>
    <meta name="author" content="CodedThemes"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @stack('meta')

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('adminhtml/images/favicon.png') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('adminhtml/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('adminhtml/plugins/animation/css/animate.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('adminhtml/css/style.css') }}">

    @stack('css')

    <!-- Required Js -->
    <script src="{{ asset('adminhtml/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('adminhtml/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminhtml/js/vendor/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('adminhtml/js/vendor/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminhtml/js/general.js') }}"></script>
    @stack('scripts')
</head>

<body>
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ navigation menu ] start -->
@include('layouts.navigation')
<!-- [ navigation menu ] end -->

<!-- [ Header ] start -->
@include('layouts.header')
<!-- [ Header ] end -->

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ Main Content ] start -->
                <x-messages></x-messages>
               {{ $slot }}
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Warning Section Starts -->
@include('layouts.warning')
<!-- Warning Section Ends -->

<script src="{{ asset('adminhtml/js/pcoded.min.js') }}"></script>
@stack('bottom-scripts')
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
</body>
</html>
