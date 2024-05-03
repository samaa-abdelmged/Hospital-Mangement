<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatList extends Component
{
    protected $listeners = ['refresh' => '$refresh'];

    public $conversations;
    public $auth_email;
    public $receviverUser;
    public $selected_conversation;
    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function getUsers(Conversation $conversation, $request)
    {


        if ($conversation->sender_email == $this->auth_email) {
            $this->receviverUser = Doctor::firstwhere('email', $conversation->receiver_email);
        } else {
            $this->receviverUser = Patient::firstwhere('email', $conversation->sender_email);
        }

        if (isset($request)) {
            return $this->receviverUser->$request;
        }

    }

    public function chatUserSelected(Conversation $conversation, $receiver_id)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = Doctor::find($receiver_id);
        $this->dispatch('load_conversation', $this->selected_conversation, $this->receviverUser);
        $this->dispatch('updateMessage', $this->selected_conversation, $this->receviverUser);
    }


    public function render()
    {
        $this->conversations = Conversation::where('sender_email', $this->auth_email)->orwhere('receiver_email', $this->auth_email)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('livewire.chat.chat-list');
    }
}