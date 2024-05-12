@extends('Dashboard.layouts.welcome-master')
@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.Services') }}</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        {{ trans('main-sidebar_trans.Single_service') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('/') }}">
                        <i class="fa fa-close"
                            style="font-size:48px;color:red;display: inline-flex; align-items: center;"></i>
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('dashboard/doctors.name') }}</th>
                                        <th>{{ trans('dashboard/doctors.img') }}</th>
                                        <th>{{ trans('dashboard/doctors.email') }}</th>
                                        <th>{{ trans('dashboard/doctors.section') }}</th>
                                        <th>{{ trans('dashboard/doctors.phone') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>

                                                @if ($doctor->image)
                                                    <img src="{{ URL::asset('Dashboard/img/doctors/' . $doctor->image->filename) }}"
                                                        height="50px" width="50px" alt="">
                                                @else
                                                    <img src="{{ URL::asset('Dashboard/img/doctor.jpg') }}" height="50px"
                                                        width="50px" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $doctor->email }}</td>
                                            <td>{{ $doctor->section->name }}</td>
                                            <td>{{ $doctor->phone }}</td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
