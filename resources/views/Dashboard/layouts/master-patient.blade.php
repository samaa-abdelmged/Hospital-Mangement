<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    @include('Dashboard.layouts.head')
</head>

<body class="main-body app sidebar-mini dark-theme">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ URL::asset('Dashboard/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @include('Dashboard.layouts.main-sidebar-patient')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('Dashboard.layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('Dashboard.layouts.sidebar')
            @include('Dashboard.layouts.models')
            @include('Dashboard.layouts.footer')
            @include('Dashboard.layouts.footer-scripts')
</body>

</html>
