<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table wire:key="foo" style="text-align: center" class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('patient/chat.doctor_name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><button class="btn btn-primary"
                                                wire:click="createConversation('{{ $user->email }}')">{{ $user->name }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->
    <!-- /row -->

</div>
@section('js')
    <!--Internal  lightslider js -->
    <script src="{{ URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js') }}"></script>
    <!--Internal  Chat js -->
    <script src="{{ URL::asset('Dashboard/js/chat.js') }}"></script>
@endsection
