@extends('Dashboard.layouts.master-patient')

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ trans('main-sidebar_trans.patient_processes') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('main-sidebar_trans.lab') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.layouts.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('patient/patient_processes.required') }}</th>
                                    <th> {{ trans('patient/patient_processes.doctor_name') }}</th>
                                    <th> {{ trans('patient/patient_processes.lab_name') }} </th>
                                    <th> {{ trans('patient/patient_processes.lab_notes') }}</th>
                                    <th> {{ trans('patient/patient_processes.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratories as $laboratorie)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laboratorie->description }}</td>
                                        <td>{{ $laboratorie->doctor->name }}</td>
                                        <td>{{ $laboratorie->employee->name }}</td>
                                        <td>{{ $laboratorie->description_employee }}</td>
                                        <td>
                                            @if ($laboratorie->employee_id !== null)
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('patient_view_laboratories', $laboratorie->id) }}"
                                                    role="button">
                                                    {{ trans('patient/patient_processes.view_analysis') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        @include('Dashboard.Sections.add')
        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
