@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ trans('main-sidebar_trans.patients') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/patient.patients_list') }}</span>
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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Patients.create') }}" class="btn btn-primary">
                            {{ trans('Dashboard/patient.Add_patient') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('Dashboard/patient.patient_name') }}</th>
                                    <th> {{ trans('Dashboard/patient.email') }}</th>
                                    <th> {{ trans('Dashboard/patient.birth_date') }}</th>
                                    <th> {{ trans('Dashboard/patient.phone_number') }}</th>
                                    <th> {{ trans('Dashboard/patient.gunder') }}</th>
                                    <th> {{ trans('Dashboard/patient.blood_type') }}</th>
                                    <th> {{ trans('Dashboard/patient.address') }}</th>
                                    <th> {{ trans('Dashboard/patient.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Patients as $Patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Patient->name }}</td>
                                        <td>{{ $Patient->email }}</td>
                                        <td>{{ $Patient->Date_Birth }}</td>
                                        <td>{{ $Patient->Phone }}</td>
                                        <td>{{ $Patient->Gender == 1 ? trans('Dashboard/patient.male') : trans('Dashboard/patient.female') }}
                                        </td>
                                        <td>{{ $Patient->Blood_Group }}</td>
                                        <td>{{ $Patient->Address }}</td>
                                        <td>
                                            <a href="{{ route('Patients.edit', $Patient->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $Patient->id }}"><i
                                                    class="fas fa-trash"></i></button>

                                            <a href="{{ route('Patients.show', $Patient->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Patients.Deleted')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
