<!DOCTYPE html>

<head>
    <style>
        #table {
            display: none;
        }
    </style>

</head>
<div class="row">


    <button class="btn btn-primary" onclick="showtable()" type="submit">عرض الخدمات </button><br>
    &nbsp; &nbsp;&nbsp;
    <button class="btn btn-primary" onclick="showform()" type="submit"> اضافة فاتورة جديدة </button><br>
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
                <th>الاسم</th>
                <th>اجمالي العرض شامل الضريبة</th>
                <th>الملاحظات</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                    <td>{{ $group->notes }}</td>
                    <td>
                        <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></button>


                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete_invoice" wire:click="delete({{ $group->id }})"><i
                                class="fa fa-trash"></i></button>


                    </td>
                </tr>
            @endforeach
    </table>
</div>

<br>

<form wire:submit.prevent="saveGroup" autocomplete="off" id="form">
    @csrf
    <div class="form-group">
        <label>اسم المجموعة</label>
        <input wire:model="name_group" type="text" name="name_group" class="form-control" required>
    </div>

    <div class="form-group">
        <label>ملاحظات</label>
        <textarea wire:model="notes" name="notes" class="form-control" rows="5"></textarea>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <div class="col-md-12">
                <button class="btn btn-outline-primary" wire:click.prevent="addService">اضافة خدمة فرعية
                </button>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th>اسم الخدمة</th>
                            <th width="200">العدد</th>
                            <th width="200">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($GroupsItems as $index => $groupItem)
                            <tr>

                                <td>
                                    @if ($groupItem['is_saved'])
                                        <input type="hidden" name="GroupsItems[{{ $index }}][service_id]"
                                            wire:model="GroupsItems.{{ $index }}.service_id" />
                                        @if ($groupItem['service_name'] && $groupItem['service_price'])
                                            {{ $groupItem['service_name'] }}
                                            ({{ number_format($groupItem['service_price'], 2) }})
                                        @endif
                                    @else
                                        <select name="GroupsItems[{{ $index }}][service_id]"
                                            class="form-control{{ $errors->has('GroupsItems.' . $index) ? ' is-invalid' : '' }}"
                                            wire:model="GroupsItems.{{ $index }}.service_id">
                                            <option value="">-- choose product --</option>
                                            @foreach ($allServices as $service)
                                                <option value="{{ $service->id }}">
                                                    {{ \App\Models\ServiceTranslation::where(['Service_id' => $service->id])->pluck('name')->first() }}
                                                    {{ number_format($service->price, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('GroupsItems.' . $index))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('GroupsItems.' . $index) }}
                                            </em>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($groupItem['is_saved'])
                                        <input type="hidden" name="GroupsItems[{{ $index }}][quantity]"
                                            wire:model="GroupsItems.{{ $index }}.quantity" />
                                        {{ $groupItem['quantity'] }}
                                    @else
                                        <input type="number" name="GroupsItems[{{ $index }}][quantity]"
                                            class="form-control"
                                            wire:model="GroupsItems.{{ $index }}.quantity" />
                                    @endif
                                </td>
                                <td>
                                    @if ($groupItem['is_saved'])
                                        <button class="btn btn-sm btn-primary"
                                            wire:click.prevent="editService({{ $index }})">
                                            تعديل
                                        </button>
                                    @elseif(!$groupItem['is_saved'])
                                        <button class="btn btn-sm btn-success mr-1" id="add"
                                            wire:click.prevent="saveService({{ $index }}) ">
                                            تاكيد
                                        </button>
                                    @endif
                                    <button class="btn btn-sm btn-danger"
                                        wire:click.prevent="removeService({{ $index }})">حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


            <div class="col-lg-4 ml-auto text-right">
                <table class="table pull-right">
                    <tr>
                        <td style="color: red">الاجمالي</td>
                        <td>{{ number_format($total, 2) }}</td>
                    </tr>

                    <tr>
                        <td style="color: red">قيمة الخصم</td>
                        <td width="125">
                            <input type="number" name="discount_value" class="form-control w-75 d-inline"
                                wire:model="discount_value" wire:change="updateValues">
                        </td>
                    </tr>

                    <tr>
                        <td style="color: red">نسبة الضريبة</td>
                        <td>
                            <input type="number" name="taxes" class="form-control w-75 d-inline" min="0"
                                max="100" wire:model="taxes" wire:change="updateValues"> %
                        </td>
                    </tr>
                    <tr>
                        <td style="color: red">الاجمالي مع الضريبة</td>
                        <td>{{ number_format($Total_with_tax, 2) }}</td>
                    </tr>
                </table>
            </div> <br />
            <div>
                <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
            </div>
        </div>
    </div>

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
