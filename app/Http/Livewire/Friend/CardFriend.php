<?php

namespace App\Http\Livewire\Friend;

use Livewire\Component;

class CardFriend extends Component
{

    public function render()
    {
        return view('livewire.friend.card-friend');
    }

    public $name, $idUser, $jmlTeman, $url, $slug;
    public function mount($name, $idUser, $jmlTeman = 0, $slug)
    {

        $this->name = $name;
        $this->idUser = $idUser;
        $this->jmlTeman = $jmlTeman;
        $this->slug = $slug;
    }
}
