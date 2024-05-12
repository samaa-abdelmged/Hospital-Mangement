@extends('Dashboard.layouts.welcome-master')
@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <div class="d-flex">

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

                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <br>

                            <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.Services') }}</h4><span
                                class="text-muted mt-1 tx-13 mr-2 mb-0">/
                                {{ trans('main-sidebar_trans.Single_service') }}</span>
                            <br>
                            <br>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('Dashboard/Services.name') }}</th>
                                    <th> {{ trans('Dashboard/Services.price') }}</th>
                                    <th> {{ trans('Dashboard/Services.description') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->price }}</td>

                                        <td> {{ Str::limit($service->description, 50) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <h4 class="content-title mb-0 my-auto"> {{ trans('dashboard/services.Services') }}</h4>
                    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        {{ trans('dashboard/services.servics_group') }}
                    </span>
                    <br>
                    <br>


                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('dashboard/services.name') }}</th>
                                    <th> قيمة الخصم</th>
                                    <th> نسبة الضريبة </th>
                                    <th> الاجمالي قبل العرض</th>
                                    <th> {{ trans('dashboard/services.total_with_tax') }}</th>
                                    <th> {{ trans('dashboard/services.notes') }}</th>
                                    <th> العرض</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->discount_value }}</td>
                                        <td>{{ $group->tax_rate }}</td>
                                        <td>{{ $group->Total_before_discount }}</td>
                                        <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                                        <td>{{ $group->notes }}</td>
                                        <td>

                                            @foreach (\App\Models\ServiceGroup::where('Group_id', $group->Group_id)->get() as $service)
                                                <span
                                                    style="display: inline-block; margin: 0 5px; padding: 10px;">{{ $service->quantity }}</span>

                                                @foreach (\App\Models\ServiceTranslation::where('service_id', $service->Service_id)->get() as $service)
                                                    <span style="display: inline-block; margin: 0 5px; padding: 5px;">
                                                        {{ $service->name }}

                                                    </span>
                                                    <hr>
                                                @endforeach
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
