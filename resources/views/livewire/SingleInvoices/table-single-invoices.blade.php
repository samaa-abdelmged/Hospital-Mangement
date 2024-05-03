<!DOCTYPE html>

<head>
    <style>
        #table {
            display: none;
        }
    </style>

</head>
<div class="row">

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <button class="btn btn-primary" onclick="showtable()" type="submit">عرض الفواتير </button><br>
    &nbsp; &nbsp;&nbsp;
    <button class="btn btn-primary" onclick="showform()" type="submit"> اضافة فاتورة جديدة </button><br>
</div>


<div class="table-responsive" id="table">
    <br>
    <br>
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الخدمة</th>
                <th>اسم المريض</th>
                <th>تاريخ الفاتورة</th>
                <th>اسم الدكتور</th>
                <th>القسم</th>
                <th>سعر الخدمة</th>
                <th>قيمة الخصم</th>
                <th>نسبة الضريبة</th>
                <th>قيمة الضريبة</th>
                <th>الاجمالي مع الضريبة</th>
                <th>نوع الفاتورة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->Service->name }}</td>
                    <td>{{ $invoice->Patient->name }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->Doctor->name }}</td>
                    <td>{{ $invoice->Section->name }}</td>
                    <td>{{ number_format($invoice->price, 2) }}</td>
                    <td>{{ number_format($invoice->discount_value, 2) }}</td>
                    <td>{{ $invoice->tax_rate }}%</td>
                    <td>{{ number_format($invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($invoice->total_with_tax, 2) }}</td>
                    <td>{{ $invoice->type == 1 ? 'نقدي' : 'اجل' }}</td>
                    <td>
                        <button wire:click="edit({{ $invoice->id }})" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete_invoice" wire:click="delete({{ $invoice->id }})"><i
                                class="fa fa-trash"></i></button>
                        <button wire:click="print({{ $invoice->id }})" class="btn btn-primary btn-sm"><i
                                class="fas fa-print" target="_blank"></i></button>

                    </td>
                </tr>
            @endforeach
    </table>
</div>

<br>
<br>

<form wire:submit.prevent="store" autocomplete="off" id="form">
    <h2 style="font-weight: bold; font-family: Cairo; color: rgb(224, 232, 236);">اضافة فاتورة جديدة</h2>

    <br>
    @csrf
    <div class="row">
        <div class="col">
            <label>اسم المريض</label>
            <select wire:model="patient_id" class="form-control" required>
                <option value="">-- اختار من القائمة --</option>
                @foreach ($Patients as $Patient)
                    <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="col">
            <label for="doctor_id">اسم الدكتور</label>
            <select wire:model="doctor_id" wire:change="get_section" class="form-control" id="doctor_id" required>
                <option value="">-- اختار من القائمة --</option>
                @foreach ($Doctors as $Doctor)
                    <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="col">
            <label for="section_id">القسم</label>
            <input wire:model="section_id" type="text" class="form-control" id="section_id" readonly>
        </div>

        <div class="col">
            <label>نوع الفاتورة</label>
            <select wire:model="type" class="form-control" {{ $updateMode == true ? 'disabled' : '' }}>
                <option value="">-- اختار من القائمة --</option>
                <option value="1">نقدي</option>
                <option value="2">اجل</option>
            </select>
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
                                    <th>اسم الخدمة</th>
                                    <th>سعر الخدمة</th>
                                    <th>قيمة الخصم</th>
                                    <th>نسبة الضريبة</th>
                                    <th>قيمة الضريبة</th>
                                    <th>الاجمالي مع الضريبة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <select wire:model="Service_id" class="form-control" wire:change="get_price"
                                            id="exampleFormControlSelect1">
                                            <option value="">-- اختار الخدمة --</option>
                                            @foreach ($Services as $Service)
                                                <option value="{{ $Service->id }}">{{ $Service->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input wire:model="price" type="text" class="form-control"
                                            wire:change="updateValues" readonly></td>

                                    <td><input wire:model="discount_value" ty pe="text" class="form-control"
                                            wire:change="updateValues"></td>

                                    <th><input wire:model="tax_rate" type="text" class="form-control"
                                            wire:change="updateValues"></th>

                                    <td><input type="text" class="form-control" readonly value="{{ $tax_value }}"
                                            wire:change="updateValues"></td>

                                    <td><input type="text" class="form-control" readonly value="{{ $subtotal }}"
                                            wire:change="updateValues">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>

    <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
</form>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="delete_invoice" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف بيانات الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                هل انت متاكد من عملية الحذف
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <button type="button" wire:click.prevent="destroy()" class="btn btn-danger">حذف</button>
            </div>

        </div>
    </div>
</div>

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
