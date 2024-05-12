@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.doctors') }}
@stop
@section('css')
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.doctors') }}</h4>
                <h4 class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('dashboard/doctors.table') }} {{ $doctor->name }}</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.layouts.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>الايام</th>
                                <th>من الساعة</th>
                                <th>الي الساعة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>السبت</td>
                            <td>{{ $doctor->day_start['1'] }}</td>
                            <td>{{ $doctor->day_end['1'] }}</td>

                        </tbody>
                        <tbody>
                            <td>الاحد</td>
                            <td>{{ $doctor->day_start['2'] }}</td>
                            <td>{{ $doctor->day_end['2'] }}</td>


                        </tbody>
                        <tbody>
                            <td>الاثنين</td>
                            <td>{{ $doctor->day_start['3'] }}</td>
                            <td>{{ $doctor->day_end['3'] }}</td>

                        </tbody>
                        <tbody>
                            <td>الثلاثاء</td>
                            <td>{{ $doctor->day_start['4'] }}</td>
                            <td>{{ $doctor->day_end['4'] }}</td>

                        </tbody>
                        <tbody>
                            <td>الاربعاء</td>
                            <td>{{ $doctor->day_start['5'] }}</td>
                            <td>{{ $doctor->day_end['5'] }}</td>

                        </tbody>
                        <tbody>
                            <td>الخميس</td>
                            <td>{{ $doctor->day_start['6'] }}</td>
                            <td>{{ $doctor->day_end['6'] }}</td>

                        </tbody>
                        <tbody>
                            <td>الجمعة</td>
                            <td>{{ $doctor->day_start['7'] }}</td>
                            <td>{{ $doctor->day_end['7'] }}</td>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('Dashboard/js/table-data.js') }}"></script>

    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
