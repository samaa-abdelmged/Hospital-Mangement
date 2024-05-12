<!-- Deleted insurance -->
<div class="modal fade" id="delete{{ $appointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/appointments.sure_delete_appointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger">{{ trans('dashboard/appointments.delete_appointment') }}</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('dashboard/appointments.close') }}</button>
                        <button class="btn btn-success">{{ trans('dashboard/appointments.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
