<?php

namespace App\Http\Controllers\Dashboard_Patient\chat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function CallComponentCreateChat()
    {
        if (Auth::guard('patient')->check()) {
            return view('livewire.chat.patient_create_chat');
        } else {
            return view('livewire.chat.doctor_create_chat');
        }
    }


    public function CallComponentMain()
    {
        if (Auth::guard('patient')->check()) {
            return view('livewire.chat.patient_main');
        } else {
            return view('livewire.chat.doctor_main');
        }
    }

}