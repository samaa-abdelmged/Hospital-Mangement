<div class="main-chat-list" id="ChatList">
    @foreach ($conversations as $conversation)
        <div class="media new"
            wire:click="chatUserSelected({{ $conversation }},'{{ $this->getUsers($conversation, $name = 'id') }}')">
            <div class="media-body">
                <div class="media-contact-name">
                    <span>{{ $this->getUsers($conversation, $name = 'name') }}</span>
                    <span>{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>
                </div>
                <p>{{ $conversation->messages->last()->body }}</p>
            </div>
        </div>
    @endforeach
</div><!-- main-chat-list -->
@section('js')
    <!--Internal  lightslider js -->
    <script src="{{ URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js') }}"></script>
    <!--Internal  Chat js -->
    <script src="{{ URL::asset('Dashboard/js/chat.js') }}"></script>
@endsection
