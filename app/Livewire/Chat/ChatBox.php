<?php

namespace App\Livewire\Chat;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;

class ChatBox extends Component
{

    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;


    #[On('load_conversation')]
    public function load_conversation(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
    }

    #[On('pushMessage')]
    public function pushMessage($messageId)
    {

        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

    }

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }


}