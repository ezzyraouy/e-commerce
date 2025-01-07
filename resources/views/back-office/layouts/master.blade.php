<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Ecomus - Ultimate Admin Dashboard HTML</title>

    <meta name="author" content="themesflat.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/dataTables.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-tagsinput.css')}}" />


    <!-- Font -->
    <link rel="stylesheet" href="{{asset('assets/admin/font/fonts.css')}}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{asset('assets/admin/icon/style.css')}}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/admin/images/favicon.png')}}">

</head>

<body>

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap loader-off">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                <!-- section-menu-left -->
                @include('back-office.layouts.side')
                <!-- /section-menu-left -->
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    <!-- @include('back-office.layouts.header') -->
                    <!-- /header-dashboard -->
                    <!-- main-content -->
                    <div class="main-content">
                        @yield('content')
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 <a href="https://dicom.ma">DICOM</a>. Design by Themesflat All rights reserved</div>
                        </div>
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
                </div>
                <!-- /section-content-right -->
            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/zoom.js')}}"></script>
    <script src="{{asset('assets/admin/js/morris.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/raphael.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/morris.js')}}"></script>
    <script src="{{asset('assets/admin/js/jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jvectormap-us-lcc.js')}}"></script>
    <script src="{{asset('assets/admin/js/jvectormap-data.js')}}"></script>
    <script src="{{asset('assets/admin/js/jvectormap.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-1.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-2.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-3.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-4.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-5.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-6.js')}}"></script>
    <script src="{{asset('assets/admin/js/apexcharts/line-chart-7.js')}}"></script>
    <script src="{{asset('assets/admin/js/switcher.js')}}"></script>
    <script defer src="{{asset('assets/admin/js/theme-settings.js')}}"></script>
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/dataTables.min.js')}}"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    @yield('scripts')
</body>

</html>