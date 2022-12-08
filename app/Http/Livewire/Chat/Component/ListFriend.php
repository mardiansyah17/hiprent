<?php

namespace App\Http\Livewire\Chat\Component;

use Livewire\Component;

class ListFriend extends Component
{
    public function render()
    {
        return view('livewire.chat.component.list-friend');
    }

    public $userId, $photo, $gender, $name;
    public function mount($user)
    {
        $this->userId = $user->id;
        $this->photo = $user->profile_photo_path;
        $this->gender = $user->gender;
        $this->name = $user->name;
    }
}
