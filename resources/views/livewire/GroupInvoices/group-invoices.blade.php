<div>
    @if ($InvoiceSaved)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> تم حفظ البيانات بنجاح. </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> تم تعديل البيانات بنجاح. </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @include('livewire.GroupInvoices.table-form')
</div>
