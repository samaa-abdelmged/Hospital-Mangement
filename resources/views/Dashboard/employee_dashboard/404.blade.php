@extends('Dashboard.layouts.master-employee')
@section('css')
    <!--- Internal Fontawesome css-->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!---Ionicons css-->
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <!---Internal Typicons css-->
    <link href="{{ URL::asset('assets/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
    <!---Internal Feather css-->
    <link href="{{ URL::asset('assets/plugins/feather/feather.css') }}" rel="stylesheet">
    <!---Internal Falg-icons css-->
    <link href="{{ URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page -->
    <div class="page">

        <!-- Main-error-wrapper -->
        <div class="main-error-wrapper  page page-h ">
            <img src="{{ URL::asset('assets/img/media/404.png') }}" class="error-page" alt="error">
            <h2> {{ trans('employee/dashboard.dd_not_exist_page') }}</h2>
            <h6> {{ trans('employee/dashboard.missed_address') }}</h6><a class="btn btn-outline-danger"
                href="{{ url('/' . ($page = 'index')) }}"> {{ trans('employee/dashboard.back_home') }}</a>
        </div>
        <!-- /Main-error-wrapper -->

    </div>
    <!-- End Page -->
@endsection
@section('js')
@endsection
