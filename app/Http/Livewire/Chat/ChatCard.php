<?php

namespace App\Http\Livewire\Chat;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatCard extends Component
{
    public $sendByUser = false, $body, $profile_photo_path, $gender;
    public function render()
    {
        return view('livewire.chat.chat-card');
    }

    public function mount($chat)
    {
        $this->body = $chat->body;
        $this->sendByUser = $chat->send_by == Auth()->id() ? true : false;
        $this->profile_photo_path = $chat->user->profile_photo_path;
        $this->gender = $chat->user->gender;
    }
}
