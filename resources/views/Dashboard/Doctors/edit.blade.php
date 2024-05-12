@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

@section('title')
    {{ trans('dashboard/doctors.add_doctor') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> {{ trans('main-sidebar_trans.doctors') }}</h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0">/
                {{ trans('dashboard/doctors.add_doctor') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@include('Dashboard.layouts.messages_alert')

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('Doctors.update', 'test') }}" method="post" autocomplete="off"
                    enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="pd-30 pd-sm-40 bg-gray-200">
                        <div>
                            @if ($doctor->image)
                                <img style="border-radius:20%"
                                    src="{{ Url::asset('Dashboard/img/doctors/' . $doctor->image->filename) }}"
                                    height="150px" width="150px" alt="">
                            @else
                                <img style="border-radius:50%"
                                    src="{{ Url::asset('Dashboard/img/doctor_default.png') }}" height="50px"
                                    width="50px" alt="">
                            @endif
                        </div>
                        <br><br>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.name') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="name" id="name" value="{{ $doctor->name }}"
                                    type="text">
                                @error('name')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.email') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" value="{{ $doctor->email }}" name="email" id="email"
                                    type="email">
                                @error('email')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.phone') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" value="{{ $doctor->phone }}" name="phone" id="phone"
                                    type="tel">
                                <input class="form-control" value="{{ $doctor->id }}" name="id" type="hidden">
                                @error('phone')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.section') }}</label>
                            </div>

                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <select name="section_id" class="form-control SlectBox">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ $section->id == $doctor->section_id ? 'selected' : '' }}>
                                            {{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class=" row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.appointments') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">

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
                                        <td><input class="form-control" value={{ $doctor->day_start['1'] }}
                                                name="day_start_1" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['1'] }}
                                                name="day_end_1" type="time"></td>
                                    </tbody>
                                    <tbody>
                                        <td>الاحد</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['2'] }}
                                                name="day_start_2" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['2'] }}
                                                name="day_end_2" type="time"></td>

                                    </tbody>
                                    <tbody>
                                        <td>الاثنين</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['3'] }}
                                                name="day_start_3" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['3'] }}
                                                name="day_end_3" type="time"></td>
                                    </tbody>
                                    <tbody>
                                        <td>الثلاثاء</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['4'] }}
                                                name="day_start_4" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['4'] }}
                                                name="day_end_4" type="time"></td>
                                    </tbody>
                                    <tbody>
                                        <td>الاربعاء</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['5'] }}
                                                name="day_start_5" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['5'] }}
                                                name="day_end_5" type="time"></td>
                                    </tbody>
                                    <tbody>
                                        <td>الخميس</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['6'] }}
                                                name="day_start_6" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['6'] }}
                                                name="day_end_6" type="time"></td>
                                    </tbody>
                                    <tbody>
                                        <td>الجمعة</td>
                                        <td><input class="form-control" value={{ $doctor->day_start['7'] }}
                                                name="day_start_7" type="time"></td>

                                        <td><input class="form-control" value={{ $doctor->day_end['7'] }}
                                                name="day_end_7" type="time"></td>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('dashboard/doctors.doctor_photo') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                <img style="border-radius:50%" width="150px" height="150px" id="output" />
                            </div>
                        </div>


                        <button type="submit"
                            class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('dashboard/doctors.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

<!--Internal  Form-elements js-->
<script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>

<!--Internal Sumoselect js-->
<script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>


<!--Internal  Datepicker js -->
<script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('dashboard/js/form-elements.js') }}"></script>
@endsection
