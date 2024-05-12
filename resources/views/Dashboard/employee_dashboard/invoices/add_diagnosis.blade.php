@extends('Dashboard.layouts.master-employee')
@section('title')
    {{ trans('employee/invoices.add_diagnosis') }}
@stop
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ trans('employee/invoices.add_diagnosis') }}
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ $invoice->Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('employee_invoices.update', $invoice->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> {{ trans('employee/invoices.diagnosis') }}
                            </label>
                            <textarea class="form-control " id="exampleFormControlTextarea1" name="description_employee" rows="3" required>
                        {{ $invoice->description_employee }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> {{ trans('employee/invoices.attachments') }}
                            </label>
                            <input type="file" name="photos[]" accept="image/*" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary"> {{ trans('employee/invoices.submit') }}
                        </button>
                    </form>
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
