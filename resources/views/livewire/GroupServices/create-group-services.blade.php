<div>

    @if ($ServiceSaved)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ trans('dashboard/services.save_successfully') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($ServiceUpdated)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ trans('dashboard/services.edit_successfully') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @include('livewire.GroupServices.table-create-group')
</div>
