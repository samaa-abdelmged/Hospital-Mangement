@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    {{ trans('Dashboard/ambulance.add_new_car') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ trans('Dashboard/ambulance.ambulance') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/ambulance.add_new_car') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.layouts.messages_alert')
    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Ambulance.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label> {{ trans('Dashboard/ambulance.car_number') }}
                                </label>
                                <input type="text" name="car_number" value="{{ old('car_number') }}"
                                    class="form-control @error('car_number') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label> {{ trans('Dashboard/ambulance.car_model') }}
                                </label>
                                <input type="text" name="car_model" value="{{ old('car_model') }}"
                                    class="form-control @error('car_model') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label> {{ trans('Dashboard/ambulance.manufacturing_year') }}
                                </label>
                                <input type="number" name="car_year_made" value="{{ old('car_year_made') }}"
                                    class="form-control @error('car_year_made') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label> {{ trans('Dashboard/ambulance.car_type') }}
                                </label>
                                <select class="form-control" name="car_type">
                                    <option value="1"> {{ trans('Dashboard/ambulance.Owned') }}
                                    </option>
                                    <option value="2"> {{ trans('Dashboard/ambulance.rented') }}
                                    </option>
                                </select>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-3">
                                <label> {{ trans('Dashboard/ambulance.driver_name') }}
                                </label>
                                <input type="text" name="driver_name" value="{{ old('driver_name') }}"
                                    class="form-control @error('driver_name') is-invalid @enderror">
                            </div>

                            <div class="col-3">
                                <label> {{ trans('Dashboard/ambulance.license_number') }}
                                </label>
                                <input type="number" name="driver_license_number"
                                    value="{{ old('driver_license_number') }}"
                                    class="form-control @error('driver_license_number') is-invalid @enderror">
                            </div>

                            <div class="col-6">
                                <label> {{ trans('Dashboard/ambulance.driver_phone') }}
                                </label>
                                <input type="number" name="driver_phone" value="{{ old('driver_phone') }}"
                                    class="form-control @error('driver_phone') is-invalid @enderror">
                            </div>

                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label> {{ trans('Dashboard/ambulance.notes') }}
                                </label>
                                <textarea rows="5" cols="10" class="form-control" name="notes"></textarea>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success"> {{ trans('Dashboard/ambulance.save_data') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
