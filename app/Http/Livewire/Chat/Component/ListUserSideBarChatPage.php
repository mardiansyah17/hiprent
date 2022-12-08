<?php

namespace App\Http\Livewire\Chat\Component;

use Livewire\Component;

class ListUserSideBarChatPage extends Component
{
    public function render()
    {
        return view('livewire.chat.component.list-user-side-bar-chat-page');
    }

    public $userId, $photo, $gender, $name, $conversationId, $lastMessage = '';
    public function mount($user)
    {
        $this->conversationId = $user->pivot->id;
        $this->userId = $user->id;
        $this->photo = $user->profile_photo_path;
        $this->gender = $user->gender;
        $this->name = $user->name;
        $this->lastMessage = $user->pivot->last_message;
    }

    protected function getListeners()
    {
        return ['setLastMessageConversation.' . $this->conversationId => 'setLastMessageConversation'];
    }

    public function setLastMessageConversation($message)
    {
        $this->lastMessage = $message;
    }
}
