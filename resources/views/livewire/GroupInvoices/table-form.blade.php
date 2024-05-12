<!DOCTYPE html>

<head>
    <style>
        #table {
            display: none;
        }
    </style>

</head>
<div class="row">


    <button class="btn btn-primary" onclick="showtable()" type="submit"> {{ trans('dashboard/invoices.view_services') }}
    </button><br>
    &nbsp; &nbsp;&nbsp;
    <button class="btn btn-primary" onclick="showform()" type="submit"> {{ trans('dashboard/invoices.add_new_invoice') }}
    </button><br>
</div>


<br>
@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<br>

<div class="table-responsive" id="table">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
            <tr>
                <th>#</th>
                <th> {{ trans('dashboard/invoices.service_name') }} </th>
                <th> {{ trans('dashboard/invoices.patient_name') }}</th>
                <th> {{ trans('dashboard/invoices.invoice_date') }}</th>
                <th> {{ trans('dashboard/invoices.doctor') }} </th>
                <th> {{ trans('dashboard/invoices.section') }}</th>
                <th> {{ trans('dashboard/invoices.service_name') }}</th>
                <th> {{ trans('dashboard/invoices.discount_value') }} </th>
                <th> {{ trans('dashboard/invoices.tax_rate') }}</th>
                <th> {{ trans('dashboard/invoices.tax_value') }} </th>
                <th> {{ trans('dashboard/invoices.total_with_tax') }}</th>
                <th> {{ trans('dashboard/invoices.invoice_type') }}</th>
                <th> {{ trans('dashboard/invoices.operations') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $group_invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $group_invoice->Group->name }}</td>
                    <td>{{ $group_invoice->Patient->name }}</td>
                    <td>{{ $group_invoice->invoice_date }}</td>
                    <td>{{ $group_invoice->Doctor->name }}</td>
                    <td>{{ $group_invoice->Section->name }}</td>
                    <td>{{ number_format($group_invoice->price, 2) }}</td>
                    <td>{{ number_format($group_invoice->discount_value, 2) }}</td>
                    <td>{{ $group_invoice->tax_rate }}%</td>
                    <td>{{ number_format($group_invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>
                    <td>{{ $group_invoice->type == 1 ? trans('dashboard/invoices.cach') : trans('dashboard/invoices.postponed') }}
                    </td>
                    <td>
                        <button wire:click="edit({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete_invoice" wire:click="delete({{ $group_invoice->id }})"><i
                                class="fa fa-trash"></i></button>

                        <button wire:click="print({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i
                                class="fas fa-print" target="_blank"></i></button>

                    </td>
                </tr>
            @endforeach
    </table>
</div>

<form wire:submit.prevent="store" autocomplete="off" id="form">
    <h2 style="font-weight: bold; font-family: Cairo; color: rgb(224, 232, 236);">
        {{ trans('dashboard/invoices.add_new_invoice') }} </h2>
    <br>
    <br>

    @csrf
    <div class="row">
        <div class="col">
            <label> {{ trans('dashboard/invoices.patient_name') }}</label>
            <select wire:model="patient_id" id="patient_id" name="patient_id" class="form-control">
                <option value="">-- {{ trans('dashboard/invoices.select_from_list') }}--</option>
                @foreach ($Patients as $Patient)
                    <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                @endforeach
            </select>
            @error('patient_id')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col">
            <label> {{ trans('dashboard/invoices.doctor') }}</label>
            <select wire:model="doctor_id" wire:change="get_section" id="doctor_id" name="doctor_id"
                class="form-control" id="exampleFormControlSelect1">
                <option value="">-- {{ trans('dashboard/invoices.select_from_list') }}--</option>
                @foreach ($Doctors as $Doctor)
                    <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                @endforeach
            </select>
            @error('doctor_id')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col">
            <label>{{ trans('dashboard/invoices.section') }}</label>
            <input wire:model="section_id" type="text" class="form-control" readonly>
        </div>


        <div class="col">
            <label>{{ trans('dashboard/invoices.invoice_type') }} </label>
            <select wire:model="type" id="type" name="type" class="form-control"
                {{ $updateMode == true ? 'disabled' : '' }}>
                <option value="">-- {{ trans('dashboard/invoices.select_from_list') }} --</option>
                <option value="1">{{ trans('dashboard/invoices.cach') }}</option>
                <option value="2">
                    {{ trans('dashboard/invoices.postponed') }}</option>
            </select>
            @error('type')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
        </div>



    </div><br>

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('dashboard/invoices.service_name') }} </th>
                                    <th> {{ trans('dashboard/invoices.service_price') }}</th>
                                    <th>{{ trans('dashboard/invoices.discount_value') }} </th>
                                    <th> {{ trans('dashboard/invoices.tax_rate') }}</th>
                                    <th>{{ trans('dashboard/invoices.tax_value') }} </th>
                                    <th> {{ trans('dashboard/invoices.total_with_tax') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <select wire:model="Group_id" id="Group_id" name="Group_id"
                                            class="form-control" wire:change="get_price" id="exampleFormControlSelect1">
                                            <option value="">--
                                                {{ trans('dashboard/invoices.select_from_list') }} --</option>
                                            @foreach ($Groups as $Group)
                                                <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('Group_id')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td><input wire:model="price" type="text" class="form-control"
                                            wire:change="updateValues" readonly></td>

                                    <td><input wire:model="discount_value" name="discount_value" id="discount_value"
                                            type="text" class="form-control" wire:change="updateValues">
                                        @error('discount_value')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <th><input wire:model="tax_rate" name="tax_rate" id="tax_rate" type="text"
                                            class="form-control" wire:change="updateValues">
                                        @error('tax_rate')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </th>
                                    <td><input type="text" class="form-control" value="{{ $tax_value }}"
                                            wire:change="updateValues" readonly></td>
                                    <td><input type="text" class="form-control" value="{{ $subtotal }}"
                                            wire:change="updateValues" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>
    <input class="btn btn-outline-success" type="submit" value={{ trans('dashboard/invoices.confirm_data') }}>
</form>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="delete_invoice" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/invoices.delete_invoice_data') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{ trans('dashboard/invoices.deletion_process') }} </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('dashboard/invoices.close') }}</button>
                <button type="button" wire:click.prevent="destroy()"
                    class="btn btn-danger">{{ trans('dashboard/invoices.delete') }}</button>
            </div>

        </div>
    </div>
</div>


<script>
    function disabled() {
        const button = document.getElementById('add');
        button.disabled = true;
    }
</script>

<script>
    function showtable() {
        document.getElementById("table").style.display = "block";
        document.getElementById("form").style.display = "none";
    }
</script>

<script>
    function showform() {
        document.getElementById("form").style.display = "block";
        document.getElementById("table").style.display = "none";
    }
</script>
