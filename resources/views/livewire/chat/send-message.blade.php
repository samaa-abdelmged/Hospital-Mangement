<div id="send-message">
    @if ($selected_conversation)
        <form wire:submit.prevent="sendMessage">
            <div class="main-chat-footer">
                <input class="form-control" wire:model="body" placeholder={{ trans('patient/chat.write_message') }}
                    type="text">
                <button class="main-msg-send" type="submit"><i class="far fa-paper-plane"></i></button>
            </div>
        </form>
    @endif
</div>
@section('js')
    <!--Internal  lightslider js -->
    <script src="{{ URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js') }}"></script>
    <!--Internal  Chat js -->
    <script src="{{ URL::asset('Dashboard/js/chat.js') }}"></script>
@endsection
