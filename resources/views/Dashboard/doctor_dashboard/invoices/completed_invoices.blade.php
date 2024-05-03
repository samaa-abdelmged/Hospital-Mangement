@extends('Dashboard.layouts.master-doctor')
@section('title')
    {{ trans('doctor/reveals.completed_reveals') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ trans('doctor/reveals.completed_reveals') }} </h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('doctor/reveals.invoices') }}</span>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('doctor/reveals.invoice_date') }}</th>
                                    <th> {{ trans('doctor/reveals.service_name') }} </th>
                                    <th> {{ trans('doctor/reveals.patient_name') }} </th>
                                    <th> {{ trans('doctor/reveals.service_price') }}</th>
                                    <th> {{ trans('doctor/reveals.discount_value') }} </th>
                                    <th> {{ trans('doctor/reveals.tax_rate') }} </th>
                                    <th> {{ trans('doctor/reveals.tax_value') }} </th>
                                    <th> {{ trans('doctor/reveals.total_with_tax') }} </th>
                                    <th> {{ trans('doctor/reveals.invoice_status') }} </th>
                                    <th> {{ trans('doctor/reveals.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->Service->name ?? $invoice->Group->name }}</td>
                                        <td><a
                                                href="{{ route('patient_details', $invoice->patient_id) }}">{{ $invoice->Patient->name }}</a>
                                        </td>
                                        <td>{{ number_format($invoice->price, 2) }}</td>
                                        <td>{{ number_format($invoice->discount_value, 2) }}</td>
                                        <td>{{ $invoice->tax_rate }}%</td>
                                        <td>{{ number_format($invoice->tax_value, 2) }}</td>
                                        <td>{{ number_format($invoice->total_with_tax, 2) }}</td>
                                        <td>
                                            @if ($invoice->invoice_status == 1)
                                                <span
                                                    class="badge badge-danger">{{ trans('doctor/reveals.under_procedure') }}
                                                </span>
                                            @elseif($invoice->invoice_status == 2)
                                                <span
                                                    class="badge badge-warning">{{ trans('doctor/reveals.review') }}</span>
                                            @else
                                                <span
                                                    class="badge badge-success">{{ trans('doctor/reveals.completed') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('Dashboard.doctor_dashboard.invoices.add_diagnosis')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

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
