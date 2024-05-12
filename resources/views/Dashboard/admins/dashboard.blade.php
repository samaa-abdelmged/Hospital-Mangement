@extends('Dashboard.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> {{ trans('dashboard/dashboard.dashboard') }}</h2>
            </div>
        </div>

    </div>

    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{ trans('dashboard/dashboard.section') }}</th>
                    <th scope="col">{{ trans('dashboard/dashboard.number') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.doctors') }}</td>
                    <td> {{ App\Models\Doctor::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.patients') }}</td>
                    <td> {{ App\Models\Patient::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.sections') }}</td>
                    <td> {{ App\Models\Section::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td> {{ trans('dashboard/dashboard.ray_employee') }}</td>
                    <td> {{ App\Models\RayEmployee::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td> {{ trans('dashboard/dashboard.lab_employee') }}</td>
                    <td>{{ App\Models\LaboratorieEmployee::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td> {{ trans('dashboard/dashboard.single_service') }}</td>
                    <td> {{ App\Models\Service::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td> {{ trans('dashboard/dashboard.group_services') }}</td>
                    <td> {{ App\Models\ServiceGroup::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.ambulances') }} </td>
                    <td> {{ App\Models\Ambulance::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.insurance_company') }} </td>
                    <td> {{ App\Models\Insurance::count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.confirmed_appointments') }} </td>
                    <td> {{ App\Models\Appointment::where('type', 'مؤكد')->count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.unconfirmed_appointments') }}</td>
                    <td> {{ App\Models\Appointment::where('type', 'غير مؤكد')->count() }}
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.single_invoices') }} </td>
                    <td> {{ App\Models\Invoice::count() }}
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>{{ trans('dashboard/dashboard.group_invoices') }} </td>
                    <td>{{ App\Models\Group::count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- row closed -->

    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('Dashboard/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('Dashboard/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('Dashboard/js/index-dark.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
