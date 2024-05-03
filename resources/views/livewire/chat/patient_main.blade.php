@extends('Dashboard.layouts.master-patient')
@section('css')
@endsection
@section('title')
    {{ trans('patient/chat.last_chats') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ trans('patient/chat.chats') }}</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        {{ trans('patient/chat.last_chats') }}</span>
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

                    <livewire:chat.main />

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
    <!--Internal  lightslider js -->
    <script src="{{ URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js') }}"></script>
    <!--Internal  Chat js -->
    <script src="{{ URL::asset('Dashboard/js/chat.js') }}"></script>
@endsection
